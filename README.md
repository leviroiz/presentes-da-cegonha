<div align="center">

# 🐣 Presentes da Cegonha

**E-commerce acadêmico em PHP e MySQL, modernizado para portfólio com foco em segurança e organização.**

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-11.4-003545?style=flat-square&logo=mariadb&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker&logoColor=white)
![Status](https://img.shields.io/badge/status-portf%C3%B3lio-6857C7?style=flat-square)

</div>

## Sobre o projeto

O **Presentes da Cegonha** nasceu em 2023 como projeto de conclusão do curso Técnico em Informática. Desenvolvido em dupla, simula uma loja de produtos infantis com cadastro e autenticação de clientes, catálogo, pedido demonstrativo e painel administrativo.

Em 2026, o código passou por uma modernização voltada a portfólio. A interface e a identidade do trabalho acadêmico foram preservadas, enquanto os fluxos críticos de autenticação, banco de dados e administração foram reorganizados e protegidos.

> Este é um projeto educacional. O pedido e o pagamento são simulações; nenhuma cobrança real é processada.

## Preview

As capturas abaixo documentam a identidade visual do projeto acadêmico. Dados de contato e credenciais usados pela aplicação atual são fictícios ou locais.

### Login

![Login](./assets/login-lightmode.png)

### Cadastro de cliente

![Cadastro](./assets/register.png)

<details>
<summary>Ver mais telas</summary>

### Login em modo escuro

![Login em modo escuro](./assets/login-darkmode.png)

### Gestão de produtos na versão acadêmica

![Lista de produtos](./assets/listar-produtos.png)

### Cadastro de produto na versão acadêmica

![Cadastro de produto](./assets/cadastrar-produto.png)

### Painel administrativo

![Painel administrativo](./assets/tela-admin.png)

</details>

## Funcionalidades

### Cliente

- Cadastro com validação server-side e senha protegida por hash.
- Login com sessão regenerada após autenticação.
- Vitrine responsiva com produtos e banners.
- Seleção de produto e preenchimento de endereço.
- Registro transacional de pedido demonstrativo com validação de estoque.
- Carrinho visual preservado como parte do protótipo acadêmico.

### Administração

- Login e autorização separados do fluxo do cliente.
- Cadastro, edição, listagem e remoção de produtos.
- Listagem e atualização de clientes sem exposição de senhas.
- Operações sensíveis por POST e protegidas contra CSRF.
- Mensagens de retorno por sessão e redirecionamento HTTP.

## O que foi modernizado

| Antes, na versão acadêmica | Agora, na versão de portfólio |
|---|---|
| SQL concatenado com entradas do formulário | Consultas preparadas com `mysqli` |
| Senhas em texto puro | `password_hash()` e `password_verify()` |
| Credenciais no código e no dump | Configuração por variáveis de ambiente |
| Exclusões acionadas por links GET | POST, CSRF e autorização administrativa |
| Verificação de sessão repetida nas páginas | Bootstrap e guardas de autenticação reutilizáveis |
| Valor do pedido enviado pelo navegador | Preço consultado e validado no servidor |
| Baixa de estoque separada do pedido | Transação no banco com bloqueio do produto |
| Dados pessoais de exemplo versionados | Catálogo fictício e banco sanitizado |
| OAuth somente no navegador | Recurso removido até existir validação server-side |

A análise completa está em [docs/SECURITY_REVIEW.md](./docs/SECURITY_REVIEW.md).

## Tecnologias

- PHP 8.2 e extensão `mysqli`
- MariaDB/MySQL
- HTML5, CSS3, JavaScript e SCSS
- Materialize CSS e jQuery no front-end original
- Docker e Docker Compose para ambiente reproduzível
- GitHub Actions para lint, verificações de segurança e testes de integração

## Estrutura principal

```text
.
├── config/                 # Ambiente, bootstrap e banco
├── includes/               # Autenticação, CSRF e helpers
├── database/migrations/    # Migração para o banco acadêmico
├── scripts/                # Criação de admin e verificação estática
├── tests/                  # Testes de segurança e integração HTTP/MariaDB
├── css/, js/, img/         # Interface e assets do projeto
├── bd_cegonha.sql          # Esquema e catálogo fictício
├── docker-compose.yml      # Aplicação + MariaDB
└── *.php                   # Páginas e endpoints
```

## Como executar com Docker

Pré-requisito: Docker Desktop com Docker Compose.

```bash
git clone https://github.com/leviroiz/presentes-da-cegonha.git
cd presentes-da-cegonha
cp .env.example .env
# Edite .env e substitua as senhas de exemplo antes de continuar.
docker compose up --build -d
docker compose exec app php scripts/create_admin.php
```

Acesse:

- Loja: `http://localhost:8080`
- Login administrativo: `http://localhost:8080/login_admin.php`

As credenciais ficam no arquivo local `.env`, ignorado pelo Git. Não há usuário administrador padrão; ele deve ser criado pelo script interativo.

No PowerShell, use `Copy-Item .env.example .env` no lugar de `cp`.

## Execução sem Docker

1. Use PHP 8.2+ com a extensão `mysqli` e MySQL/MariaDB.
2. Importe `bd_cegonha.sql`.
3. Copie `.env.example` para `.env` e ajuste somente as credenciais locais.
4. Execute `php scripts/create_admin.php`.
5. Sirva a raiz do projeto com Apache ou `php -S localhost:8080`.

O arquivo `.env` é ignorado pelo Git e não deve ser publicado.

## Qualidade e testes

```bash
find . -type f -name '*.php' -print0 | xargs -0 -n1 php -l
php scripts/security_check.php
php tests/security_smoke.php
```

Essas verificações também são executadas no GitHub Actions a cada `push` e `pull request`.

O workflow ainda sobe um MariaDB isolado, inicializa o esquema e testa por HTTP os fluxos de cadastro, login, autorização administrativa, CRUD de produtos e pedido transacional. Os dados criados pela suíte são fictícios e removidos ao final da execução.

## Histórico preservado

- `v1-academico-2023`: código original do projeto acadêmico.
- `main`: versão modernizada, revisada e validada automaticamente.

Essa separação permite comparar a evolução técnica sem apagar o contexto em que o projeto foi criado.

## Minha participação

| Responsabilidade | Participação |
|---|---|
| Interface, responsividade e integração das telas | **Carlos Levi — Front-End e apoio no Back-End** |
| Lógica de servidor na versão acadêmica | Desenvolvimento em dupla |
| Auditoria e modernização para portfólio | **Carlos Levi** |

## Limitações e próximos passos

- Transformar o carrinho visual em um fluxo persistente de múltiplos itens.
- Expandir a cobertura automatizada para recuperação de senha e concorrência de estoque.
- Implementar recuperação de senha e proteção contra tentativas repetidas.
- Aplicar HTTPS e cabeçalhos de segurança no ambiente publicado.
- Revisar privacidade, retenção de dados e requisitos da LGPD antes de qualquer uso real.

---

<div align="center">

Desenvolvido por [Carlos Levi](https://github.com/leviroiz) e equipe • Projeto acadêmico de 2023, modernizado para portfólio

</div>
