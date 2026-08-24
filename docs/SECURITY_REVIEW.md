# Revisão de segurança

Este documento registra a modernização do projeto acadêmico de 2023. A versão original permanece preservada na tag `v1-academico-2023`; a implementação atual foi construída na branch `refactor/portfolio`.

## Principais riscos identificados

- SQL construído por concatenação de entradas do usuário.
- Senhas armazenadas e exibidas em texto puro.
- Credenciais padrão e dados pessoais de exemplo no dump público.
- Exclusões realizadas por requisições GET.
- Páginas administrativas com validação de sessão incompleta.
- Formulários sem proteção CSRF.
- Login social apenas no navegador, sem validação segura no servidor.
- Registro de pagamento sem vincular corretamente cliente e produto e com valor vindo do formulário.

## Controles implementados

- Consultas preparadas com `mysqli` em autenticação, cadastros, alterações, exclusões e pedidos.
- `password_hash()` e `password_verify()` para clientes e administradores.
- Cookies de sessão `HttpOnly`, `SameSite=Lax` e opção `Secure` por ambiente.
- Regeneração do ID de sessão após autenticação.
- Guardas separadas para cliente e administrador.
- Token CSRF em todas as operações que alteram estado.
- Exclusões convertidas para POST com confirmação e autorização administrativa.
- Validação server-side, listas de valores permitidos e escape somente na saída HTML.
- Credenciais e conexão movidas para variáveis de ambiente.
- Dados pessoais e credenciais padrão removidos do banco versionado.
- Acesso HTTP direto a configuração, scripts, testes e dump SQL bloqueado no Apache.
- Fluxo de pedido transacional: preço lido do banco, validação de estoque e baixa atômica.
- Login social removido até que possa ser validado no servidor.
- Testes estáticos e smoke tests executados no CI.

## Limites conhecidos

- O pagamento é somente uma simulação acadêmica; não existe gateway nem processamento de cartão.
- O carrinho original é uma demonstração visual e ainda não persiste múltiplos itens.
- O projeto não deve ser tratado como uma loja pronta para produção sem testes de integração, política de privacidade, logs, observabilidade e revisão de infraestrutura.
- Dados pessoais reais não devem ser inseridos em ambientes públicos de demonstração.

## Próximos passos recomendados

1. Testes de integração com banco isolado.
2. Rate limiting e bloqueio progressivo de tentativas de login.
3. Recuperação de senha com tokens curtos e de uso único.
4. Política de retenção e exclusão de dados compatível com a LGPD.
5. Cabeçalhos HTTP de segurança e HTTPS obrigatório no ambiente publicado.
