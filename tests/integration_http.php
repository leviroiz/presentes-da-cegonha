<?php

declare(strict_types=1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

final class HttpClient
{
    private string $baseUrl;
    private string $cookieFile;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $cookieFile = tempnam(sys_get_temp_dir(), 'cegonha-cookie-');

        if ($cookieFile === false) {
            throw new RuntimeException('Não foi possível criar o arquivo temporário de cookies.');
        }

        $this->cookieFile = $cookieFile;
    }

    public function __destruct()
    {
        if (is_file($this->cookieFile)) {
            unlink($this->cookieFile);
        }
    }

    /**
     * @param array<string, string|int|float> $data
     * @return array{status: int, headers: array<string, string>, body: string}
     */
    public function request(string $method, string $path, array $data = []): array
    {
        $headers = [];
        $curl = curl_init($this->baseUrl . '/' . ltrim($path, '/'));

        if ($curl === false) {
            throw new RuntimeException('Não foi possível inicializar o cliente HTTP.');
        }

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_COOKIEJAR => $this->cookieFile,
            CURLOPT_COOKIEFILE => $this->cookieFile,
            CURLOPT_USERAGENT => 'Presentes-da-Cegonha-integration-tests/1.0',
            CURLOPT_HEADERFUNCTION => static function ($handle, string $line) use (&$headers): int {
                $length = strlen($line);
                $separator = strpos($line, ':');

                if ($separator !== false) {
                    $name = strtolower(trim(substr($line, 0, $separator)));
                    $headers[$name] = trim(substr($line, $separator + 1));
                }

                return $length;
            },
        ]);

        if (strtoupper($method) === 'POST') {
            curl_setopt_array($curl, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
            ]);
        }

        $body = curl_exec($curl);

        if ($body === false) {
            $message = curl_error($curl);
            curl_close($curl);
            throw new RuntimeException('Falha na requisição HTTP: ' . $message);
        }

        $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl);

        return ['status' => $status, 'headers' => $headers, 'body' => $body];
    }
}

function assert_true(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

/** @param mixed $actual */
function assert_same_value($expected, $actual, string $message): void
{
    if ($expected !== $actual) {
        throw new RuntimeException(
            $message . ' Esperado: ' . var_export($expected, true) . '; recebido: ' . var_export($actual, true) . '.'
        );
    }
}

/** @param array{status: int, headers: array<string, string>, body: string} $response */
function assert_redirect(array $response, string $location, string $message): void
{
    assert_same_value(303, $response['status'], $message . ' O status deveria ser 303.');
    assert_same_value($location, $response['headers']['location'] ?? null, $message . ' Destino inesperado.');
}

function csrf_from(string $html): string
{
    $matched = preg_match(
        '/name=["\']csrf_token["\'][^>]*value=["\']([^"\']+)["\']/i',
        $html,
        $matches
    );

    if ($matched !== 1) {
        throw new RuntimeException('Token CSRF não encontrado na resposta HTML.');
    }

    return html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function connect_database(): mysqli
{
    $connection = new mysqli(
        getenv('DB_HOST') ?: '127.0.0.1',
        getenv('DB_USER') ?: 'root',
        getenv('DB_PASSWORD') ?: '',
        getenv('DB_NAME') ?: 'bd_cegonha',
        (int) (getenv('DB_PORT') ?: '3306')
    );
    $connection->set_charset('utf8mb4');

    return $connection;
}

function cleanup_fixtures(mysqli $database, string $email, string $cpf, string $adminLogin, array $productNames): void
{
    $paymentDelete = $database->prepare(
        'DELETE payment FROM tb_realiza_pagamento payment
         INNER JOIN tb_cliente customer ON customer.id_cliente = payment.id_cliente
         WHERE customer.email = ? OR customer.cpf = ?'
    );
    $paymentDelete->bind_param('ss', $email, $cpf);
    $paymentDelete->execute();

    $customerDelete = $database->prepare('DELETE FROM tb_cliente WHERE email = ? OR cpf = ?');
    $customerDelete->bind_param('ss', $email, $cpf);
    $customerDelete->execute();

    $productDelete = $database->prepare('DELETE FROM tb_produtos WHERE nome = ?');
    foreach ($productNames as $productName) {
        $productDelete->bind_param('s', $productName);
        $productDelete->execute();
    }

    $adminDelete = $database->prepare('DELETE FROM tb_admin WHERE login = ?');
    $adminDelete->bind_param('s', $adminLogin);
    $adminDelete->execute();
}

$baseUrl = getenv('APP_URL') ?: 'http://127.0.0.1:8080';
$customerEmail = 'integration.customer@example.test';
$customerCpf = '52998224725';
$customerPassword = 'Integration!123';
$adminLogin = 'integration_admin';
$adminPassword = 'AdminIntegration!123';
$productOriginal = 'Produto integração CI';
$productEdited = 'Produto integração CI editado';
$orderProduct = 'Produto pedido integração CI';
$productNames = [$productOriginal, $productEdited, $orderProduct];
$database = null;

try {
    $database = connect_database();
    cleanup_fixtures($database, $customerEmail, $customerCpf, $adminLogin, $productNames);

    $customer = new HttpClient($baseUrl);
    $registrationPage = $customer->request('GET', 'cadastro_cliente.php');
    assert_same_value(200, $registrationPage['status'], 'A página de cadastro não respondeu corretamente.');
    assert_same_value(
        'nosniff',
        strtolower($registrationPage['headers']['x-content-type-options'] ?? ''),
        'O cabeçalho X-Content-Type-Options não foi enviado.'
    );
    assert_same_value(
        'deny',
        strtolower($registrationPage['headers']['x-frame-options'] ?? ''),
        'O cabeçalho X-Frame-Options não foi enviado.'
    );

    $missingCsrf = $customer->request('POST', 'cadastro_clientebd.php', [
        'nome' => 'Cliente sem CSRF',
    ]);
    assert_same_value(419, $missingCsrf['status'], 'Uma escrita sem CSRF deveria ser rejeitada.');

    $registrationPage = $customer->request('GET', 'cadastro_cliente.php');
    $registration = $customer->request('POST', 'cadastro_clientebd.php', [
        'csrf_token' => csrf_from($registrationPage['body']),
        'nome' => 'Cliente Integração',
        'senha' => $customerPassword,
        'telefone' => '31999998888',
        'email' => $customerEmail,
        'data_nascimento' => '2000-01-15',
        'cpf' => $customerCpf,
        'CEP' => '30110020',
        'cidade' => 'Belo Horizonte',
        'bairro' => 'Centro',
        'rua' => 'Rua de Teste',
        'n_residencia' => '100',
        'sexo' => 'Outro',
    ]);
    assert_redirect($registration, 'login.php', 'O cadastro válido não foi concluído.');

    $customerSelect = $database->prepare('SELECT id_cliente, senha FROM tb_cliente WHERE email = ? LIMIT 1');
    $customerSelect->bind_param('s', $customerEmail);
    $customerSelect->execute();
    $customerRow = $customerSelect->get_result()->fetch_assoc();
    assert_true(is_array($customerRow), 'O cliente cadastrado não foi persistido.');
    assert_true($customerRow['senha'] !== $customerPassword, 'A senha do cliente foi salva em texto puro.');
    assert_true(password_verify($customerPassword, $customerRow['senha']), 'O hash da senha do cliente é inválido.');

    $loginPage = $customer->request('GET', 'login.php');
    $login = $customer->request('POST', 'validar_user.php', [
        'csrf_token' => csrf_from($loginPage['body']),
        'next' => 'home.php',
        'email' => $customerEmail,
        'senha' => $customerPassword,
    ]);
    assert_redirect($login, 'home.php', 'O login do cliente falhou.');
    assert_same_value(200, $customer->request('GET', 'home.php')['status'], 'A sessão do cliente não foi mantida.');
    echo "PASS: cadastro, senha protegida e login de cliente.\n";

    $anonymousAdmin = new HttpClient($baseUrl);
    assert_redirect(
        $anonymousAdmin->request('GET', 'tela_admin.php'),
        'login_admin.php',
        'O painel administrativo aceitou uma sessão anônima.'
    );

    $adminHash = password_hash($adminPassword, PASSWORD_DEFAULT);
    $adminInsert = $database->prepare(
        'INSERT INTO tb_admin (nome, login, senha, status_login) VALUES (?, ?, ?, ?)'
    );
    $adminName = 'Administrador Integração';
    $activeStatus = 'ativo';
    $adminInsert->bind_param('ssss', $adminName, $adminLogin, $adminHash, $activeStatus);
    $adminInsert->execute();

    $admin = new HttpClient($baseUrl);
    $adminLoginPage = $admin->request('GET', 'login_admin.php');
    $adminLoginResponse = $admin->request('POST', 'validar_admin.php', [
        'csrf_token' => csrf_from($adminLoginPage['body']),
        'login' => $adminLogin,
        'senha' => $adminPassword,
    ]);
    assert_redirect($adminLoginResponse, 'tela_admin.php', 'O login administrativo falhou.');
    assert_same_value(200, $admin->request('GET', 'tela_admin.php')['status'], 'A sessão administrativa não foi mantida.');

    $createPage = $admin->request('GET', 'cadastrar_produto.php');
    $createProduct = $admin->request('POST', 'cadastrar_produtobd.php', [
        'csrf_token' => csrf_from($createPage['body']),
        'nome' => $productOriginal,
        'categoria' => 'Testes automatizados',
        'preco' => '87.65',
        'estoque' => '4',
    ]);
    assert_redirect($createProduct, 'listar_produtos.php', 'O cadastro administrativo de produto falhou.');

    $productSelect = $database->prepare(
        'SELECT id_produto, nome, preco, estoque, categoria FROM tb_produtos WHERE nome = ? LIMIT 1'
    );
    $productSelect->bind_param('s', $productOriginal);
    $productSelect->execute();
    $productRow = $productSelect->get_result()->fetch_assoc();
    assert_true(is_array($productRow), 'O produto criado não foi persistido.');
    $productId = (int) $productRow['id_produto'];
    assert_same_value('Testes automatizados', $productRow['categoria'], 'A categoria persistida está incorreta.');

    $editPage = $admin->request('GET', 'alterar_produto.php?id=' . $productId);
    $editProduct = $admin->request('POST', 'alterar_produtobd.php', [
        'csrf_token' => csrf_from($editPage['body']),
        'id_produto' => $productId,
        'nome' => $productEdited,
        'preco' => '99.90',
        'estoque' => '7',
    ]);
    assert_redirect($editProduct, 'listar_produtos.php', 'A edição administrativa de produto falhou.');

    $editedSelect = $database->prepare('SELECT nome, preco, estoque FROM tb_produtos WHERE id_produto = ?');
    $editedSelect->bind_param('i', $productId);
    $editedSelect->execute();
    $editedRow = $editedSelect->get_result()->fetch_assoc();
    assert_same_value($productEdited, $editedRow['nome'] ?? null, 'O nome do produto não foi atualizado.');
    assert_same_value('99.90', $editedRow['preco'] ?? null, 'O preço do produto não foi atualizado.');
    assert_same_value(7, (int) ($editedRow['estoque'] ?? -1), 'O estoque do produto não foi atualizado.');

    $productList = $admin->request('GET', 'listar_produtos.php');
    assert_true(strpos($productList['body'], $productEdited) !== false, 'O produto editado não aparece na listagem.');
    $deleteProduct = $admin->request('POST', 'deletar_produto.php', [
        'csrf_token' => csrf_from($productList['body']),
        'id_produto' => $productId,
    ]);
    assert_redirect($deleteProduct, 'listar_produtos.php', 'A exclusão administrativa de produto falhou.');

    $deletedSelect = $database->prepare('SELECT COUNT(*) AS total FROM tb_produtos WHERE id_produto = ?');
    $deletedSelect->bind_param('i', $productId);
    $deletedSelect->execute();
    $deletedTotal = (int) $deletedSelect->get_result()->fetch_assoc()['total'];
    assert_same_value(0, $deletedTotal, 'O produto excluído ainda existe no banco.');
    echo "PASS: autorização e CRUD administrativo de produtos.\n";

    $orderCreatePage = $admin->request('GET', 'cadastrar_produto.php');
    $orderCreate = $admin->request('POST', 'cadastrar_produtobd.php', [
        'csrf_token' => csrf_from($orderCreatePage['body']),
        'nome' => $orderProduct,
        'categoria' => 'Testes automatizados',
        'preco' => '123.45',
        'estoque' => '3',
    ]);
    assert_redirect($orderCreate, 'listar_produtos.php', 'O produto de teste do pedido não foi criado.');

    $orderProductSelect = $database->prepare(
        'SELECT id_produto, preco, estoque FROM tb_produtos WHERE nome = ? LIMIT 1'
    );
    $orderProductSelect->bind_param('s', $orderProduct);
    $orderProductSelect->execute();
    $orderProductRow = $orderProductSelect->get_result()->fetch_assoc();
    assert_true(is_array($orderProductRow), 'O produto de teste do pedido não foi persistido.');
    $orderProductId = (int) $orderProductRow['id_produto'];

    $paymentPage = $customer->request('GET', 'tela_pagamento.php?produto_id=' . $orderProductId);
    assert_same_value(200, $paymentPage['status'], 'A tela de pedido não foi carregada.');
    $payment = $customer->request('POST', 'pagamentobd.php', [
        'csrf_token' => csrf_from($paymentPage['body']),
        'id_produto' => $orderProductId,
        'cep' => '30110020',
        'cidade' => 'Belo Horizonte',
        'bairro' => 'Centro',
        'rua' => 'Rua de Teste',
        'n_residencia' => '100',
        'tipo_pagamento' => 'Pix',
        'valor' => '0.01',
    ]);
    assert_redirect($payment, 'paychecked.php', 'O pedido demonstrativo não foi registrado.');

    $paymentSelect = $database->prepare(
        'SELECT valor, tipo_pagamento FROM tb_realiza_pagamento
         WHERE id_cliente = ? AND id_produto = ? ORDER BY id_pagamento DESC LIMIT 1'
    );
    $customerId = (int) $customerRow['id_cliente'];
    $paymentSelect->bind_param('ii', $customerId, $orderProductId);
    $paymentSelect->execute();
    $paymentRow = $paymentSelect->get_result()->fetch_assoc();
    assert_true(is_array($paymentRow), 'O registro do pedido não foi persistido.');
    assert_same_value('123.45', $paymentRow['valor'], 'O pedido não usou o preço confiável do servidor.');
    assert_same_value('Pix', $paymentRow['tipo_pagamento'], 'O tipo de pagamento não foi persistido.');

    $stockSelect = $database->prepare('SELECT estoque FROM tb_produtos WHERE id_produto = ?');
    $stockSelect->bind_param('i', $orderProductId);
    $stockSelect->execute();
    $remainingStock = (int) $stockSelect->get_result()->fetch_assoc()['estoque'];
    assert_same_value(2, $remainingStock, 'A baixa transacional de estoque não ocorreu.');

    $confirmation = $customer->request('GET', 'paychecked.php');
    assert_same_value(200, $confirmation['status'], 'A confirmação do pedido não foi carregada.');
    assert_true(
        strpos($confirmation['body'], 'Pedido registrado!') !== false,
        'A confirmação de sucesso não foi exibida.'
    );
    echo "PASS: pedido transacional, preço no servidor e baixa de estoque.\n";
    echo "Integração HTTP com MariaDB: OK.\n";
} catch (Throwable $exception) {
    fwrite(STDERR, "Integração HTTP com MariaDB: FALHOU. {$exception->getMessage()}\n");
    $exitCode = 1;
} finally {
    if ($database instanceof mysqli) {
        try {
            cleanup_fixtures($database, $customerEmail, $customerCpf, $adminLogin, $productNames);
        } catch (Throwable $cleanupException) {
            fwrite(STDERR, "Aviso: falha ao remover fixtures: {$cleanupException->getMessage()}\n");
            $exitCode = 1;
        }
    }
}

exit($exitCode ?? 0);
