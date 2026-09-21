# Presentes da Cegonha — E-commerce Modernization

An academic e-commerce project from 2023 revisited three years later to improve its security, data integrity, development environment and automated validation.

The value of this repository is not only the application itself. It preserves two stages of the same project, making it possible to compare how I approached software development at the beginning of my journey with how I would approach the same problems today.

<p>
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/MariaDB-11.4-003545?style=flat-square&logo=mariadb&logoColor=white" alt="MariaDB 11.4">
  <img src="https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker&logoColor=white" alt="Docker Compose">
  <img src="https://img.shields.io/badge/GitHub_Actions-CI-2088FF?style=flat-square&logo=githubactions&logoColor=white" alt="GitHub Actions CI">
</p>

[![Quality Checks](https://github.com/leviroiz/presentes-da-cegonha/actions/workflows/quality.yml/badge.svg)](https://github.com/leviroiz/presentes-da-cegonha/actions/workflows/quality.yml)

---

## Context

Presentes da Cegonha started in **2023** as a final project for a Technical Degree in Information Technology.

The original application simulated an e-commerce platform for children's products with customer accounts, a product catalog, an administrative area, stock control and a demonstration order flow.

At that point, the main goal was to make the application work.

In **2026**, I returned to the same codebase with a different question:

> What would I change now that I understand more about security, data integrity, testing and software maintenance?

Instead of hiding the old implementation, the repository preserves it as part of the project's history.

The original version is available in the [`v1-academico-2023`](https://github.com/leviroiz/presentes-da-cegonha/tree/v1-academico-2023) tag.

The `main` branch contains the modernized version.

---

## What changed

| 2023 academic version | Modernized version |
|---|---|
| SQL assembled through string concatenation | Prepared statements with `mysqli` |
| Plain-text passwords | `password_hash()` and `password_verify()` |
| Database credentials inside the codebase | Environment-based configuration |
| State-changing operations through GET | POST + authorization + CSRF |
| Scattered session validation | Reusable authentication guards |
| Browser input treated as trusted | Critical values validated server-side |
| Order and stock operations separated | Transactional order and stock update |
| Personal/sample operational data | Sanitized synthetic data |
| Client-side social login | Removed until secure server-side validation exists |
| Manual local setup | Reproducible Docker environment |
| No automated integration validation | CI with security, smoke and HTTP integration tests |

The goal was not to rewrite everything with a new framework.

Part of the original structure was intentionally preserved so the evolution of the project remains visible.

---

## What made the modernization interesting

### Trust boundaries

One of the most important changes was deciding which information the browser should be allowed to control.

For example, the order form sends the product identifier, but the final price is loaded again from the database on the server.

A manipulated value sent by the browser therefore does not determine the price stored with the order.

```text
Browser sends product ID
        │
        ▼
Server loads product
        │
        ▼
Database provides price
        │
        ▼
Stock is validated
        │
        ▼
Order is recorded
```

### Order and stock consistency

Creating an order and reducing inventory are related operations.

The modernized flow executes them inside the same database transaction.

```text
BEGIN TRANSACTION
        │
        ▼
SELECT product FOR UPDATE
        │
        ▼
Validate stock
        │
        ▼
Read trusted price
        │
        ▼
Insert order
        │
        ▼
Reduce stock
        │
        ▼
COMMIT
```

If the operation fails, the transaction is rolled back instead of leaving the order and inventory in conflicting states.

### Authentication is not enough

The original application already had login screens, but authentication alone does not make sensitive operations safe.

The modernization added clearer separation between customer and administrator access and requires authorization for administrative operations.

State-changing requests also use CSRF protection instead of relying on the fact that the user is logged in.

### Old code is useful evidence

This project intentionally keeps its academic origin visible.

The differences between the two versions document changes in how I think about:

```text
input validation
authentication
authorization
database integrity
secrets
testing
deployment environments
error handling
```

That evolution is one of the main reasons this repository remains public.

---

## Security improvements

The modernized version includes controls such as:

- prepared SQL statements with `mysqli`
- `password_hash()` and `password_verify()`
- session ID regeneration after authentication
- `HttpOnly` session cookies
- `SameSite=Lax`
- optional secure session cookies by environment
- separate customer and administrator guards
- CSRF protection for state-changing operations
- POST requests for destructive actions
- server-side validation
- output escaping
- environment-based database credentials
- sanitized database fixtures
- restricted direct access to internal files
- server-side product pricing
- transactional inventory updates

The repository contains a more detailed review in:

[Security Review](docs/SECURITY_REVIEW.md)

This does not mean the project is presented as production-ready. The controls represent improvements to an educational application and a practical exercise in revisiting old architectural decisions.

---

## Testing and CI

GitHub Actions runs automated validation on pushes and pull requests.

The CI currently contains two main jobs:

```text
Quality checks
│
├── PHP syntax validation
├── Security checks
└── Security smoke tests

HTTP integration
│
├── MariaDB 11.4
├── PHP 8.2 test server
└── HTTP integration suite
```

The integration tests exercise actual HTTP requests against the application and a MariaDB service.

They validate behavior including:

- customer registration
- password hashing
- customer login
- session persistence
- anonymous administrator access blocking
- administrator authentication
- product creation
- product editing
- product deletion
- database persistence
- CSRF enforcement
- demonstration order creation
- server-side product pricing
- transactional stock reduction
- order confirmation

Synthetic fixtures are removed after the test run.

The repository currently uses **continuous integration**, not a production deployment pipeline.

---

## Architecture

```text
Browser
   │
   ▼
HTML / CSS / JavaScript
   │
   ▼
PHP 8.2
   │
   ├── Authentication
   ├── Authorization
   ├── CSRF
   ├── Validation
   └── Business Rules
   │
   ▼
mysqli
   │
   ▼
MariaDB
```

The project intentionally remains close to its original PHP architecture rather than being rebuilt with a modern framework.

That makes the comparison with the 2023 version much more meaningful.

---

## Preview

### Customer login

<p align="center">
  <img src="./assets/login-lightmode.png" alt="Customer login screen" width="900">
</p>

### Customer registration

<p align="center">
  <img src="./assets/register.png" alt="Customer registration screen" width="900">
</p>

<details>
<summary><strong>More screens</strong></summary>

<br>

### Dark mode login

![Dark mode login](./assets/login-darkmode.png)

### Product management

![Product list](./assets/listar-produtos.png)

### Product registration

![Product registration](./assets/cadastrar-produto.png)

### Admin dashboard

![Admin dashboard](./assets/tela-admin.png)

</details>

---

## Running with Docker

### Requirements

- Docker
- Docker Compose

Clone the repository:

```bash
git clone https://github.com/leviroiz/presentes-da-cegonha.git
cd presentes-da-cegonha
```

Create the environment file:

```bash
cp .env.example .env
```

On PowerShell:

```powershell
Copy-Item .env.example .env
```

Configure the local database credentials in `.env`, then start the environment:

```bash
docker compose up --build -d
```

Create an administrator:

```bash
docker compose exec app php scripts/create_admin.php
```

Open:

```text
Store
http://localhost:8080

Administration
http://localhost:8080/login_admin.php
```

No default administrator account is included.

To stop the environment:

```bash
docker compose down
```

---

## Technology

The modernized project uses:

```text
Backend
PHP 8.2
mysqli
MariaDB 11.4

Frontend
HTML
CSS / SCSS
JavaScript
Materialize
jQuery

Development
Docker
Docker Compose
GitHub Actions
Git
```

Some frontend dependencies originate from the original academic project and were intentionally preserved.

---

## Contribution

The original 2023 project was developed by two students.

My contribution to the academic version focused primarily on the interface, responsiveness and integration between screens, while backend development was collaborative.

The 2026 modernization — including the security review, backend hardening, Docker environment, automated tests, CI and technical documentation — was carried out by me.

Keeping that distinction explicit is important because the repository represents both a collaborative academic project and my later individual work on top of it.

---

## Limits

This remains an educational application.

It is not presented as a production-ready e-commerce platform and does not include areas such as:

- real payment processing
- a payment gateway
- complete multi-item cart persistence
- password recovery
- rate limiting
- production observability
- production infrastructure hardening
- complete privacy and regulatory workflows

The purpose of the modernization was to improve the engineering quality of the original project and document technical evolution, not to transform it into a commercial store.

---

## Project history

```text
2023
│
├── Technical course final project
├── First full-stack experience
└── Academic implementation

            ↓

2026
│
├── Security review
├── Backend hardening
├── Database integrity improvements
├── Docker environment
├── Automated testing
├── Continuous integration
└── Technical documentation
```

The original state remains available in the [`v1-academico-2023`](https://github.com/leviroiz/presentes-da-cegonha/tree/v1-academico-2023) tag.

---

## License

The project code is available under the [MIT License](LICENSE).

Third-party license notices are preserved separately. Materialize's original MIT license is available at:

[`licenses/MATERIALIZE_LICENSE`](licenses/MATERIALIZE_LICENSE)
