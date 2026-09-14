<div align="center">

# 🐣 Presentes da Cegonha — E-commerce

**Modernized academic e-commerce project built with PHP, MariaDB, Docker, automated tests, and CI/CD.**

<p>
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/MariaDB-11.4-003545?style=for-the-badge&logo=mariadb&logoColor=white" alt="MariaDB">
  <img src="https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
  <img src="https://img.shields.io/badge/GitHub_Actions-CI-2088FF?style=for-the-badge&logo=githubactions&logoColor=white" alt="GitHub Actions">
</p>

[![Quality Checks](https://github.com/leviroiz/presentes-da-cegonha/actions/workflows/quality.yml/badge.svg)](https://github.com/leviroiz/presentes-da-cegonha/actions/workflows/quality.yml)

</div>

---

## 🚀 Overview

**Presentes da Cegonha** started in 2023 as a final project for a Technical Degree in Information Technology.

The original application simulated an e-commerce platform for children's products with:

- customer registration and authentication
- product catalog
- administrative dashboard
- product and customer management
- stock control
- demonstration order flow

In 2026, I revisited the project with a different goal: **turning an old academic application into a more mature portfolio project**.

The modernization focused on:

- web security
- server-side validation
- authentication and authorization
- database integrity
- automated testing
- Docker-based reproducibility
- CI/CD

> [!NOTE]
> This remains an educational project.
>
> Orders and payments are simulated, and no real financial processing is performed.

---

## 🖥️ Preview

### Customer Login

<p align="center">
  <img src="./assets/login-lightmode.png" alt="Customer login screen" width="900">
</p>

### Customer Registration

<p align="center">
  <img src="./assets/register.png" alt="Customer registration screen" width="900">
</p>

<details>
<summary><strong>📸 More Screens</strong></summary>

<br>

### Dark Mode Login

![Dark mode login](./assets/login-darkmode.png)

### Product Management

![Product list](./assets/listar-produtos.png)

### Product Registration

![Product registration](./assets/cadastrar-produto.png)

### Admin Dashboard

![Admin dashboard](./assets/tela-admin.png)

</details>

---

## ✨ Key Features

### 🛍️ Customer Flow

- account creation
- server-side input validation
- secure password storage
- session-based authentication
- product catalog
- product details
- address information
- demonstration order creation
- stock validation
- order confirmation

### 🛠️ Administration

- separate administrator authentication
- role-based access control
- product CRUD
- customer management
- stock control
- server-side validation
- state-changing operations using `POST`
- CSRF protection

---

## 🔄 From Academic Project to Portfolio Project

One of the main goals of this repository is to show technical evolution.

| Academic version — 2023 | Modernized version |
|---|---|
| SQL built through string concatenation | Prepared statements with `mysqli` |
| Plain-text passwords | `password_hash()` and `password_verify()` |
| Credentials inside source code | Environment variables |
| Sensitive actions through GET | POST + CSRF + authorization |
| Scattered session checks | Reusable authentication guards |
| Browser values treated as trusted | Critical values validated server-side |
| Orders and stock handled separately | Transactional database operation |
| Personal sample data | Sanitized synthetic dataset |
| Client-side social login only | Removed until server-side validation exists |

The original academic version is preserved in:

```text
v1-academico-2023
```

The `main` branch contains the modernized portfolio version.

---

## 🔐 Security Improvements

The modernization introduced several security controls:

- prepared statements with `mysqli`
- secure password hashing
- session ID regeneration after authentication
- `HttpOnly` session cookies
- `SameSite=Lax`
- optional `Secure` cookie flag
- separate customer and administrator authentication
- CSRF protection
- server-side validation
- output escaping
- credentials through environment variables
- sanitized database content
- protection against direct access to internal files
- server-side product pricing
- transactional stock updates

A more detailed security review is available in:

[🔐 Security Review](./docs/SECURITY_REVIEW.md)

---

## 💳 Order & Stock Integrity

The modernized order flow does not trust pricing values received from the browser.

```text
Customer selects product
        │
        ▼
Server receives product ID
        │
        ▼
Product loaded from database
        │
        ▼
Server determines real price
        │
        ▼
Stock validated
        │
        ▼
Order recorded
        │
        ▼
Stock updated
        │
        ▼
Database transaction committed
```

This prevents manipulated frontend values from changing the price stored by the application.

Order creation and stock reduction are handled inside the same database transaction.

---

## 🏗️ Architecture

```text
Browser
   │
   ▼
HTML + CSS + JavaScript
   │
   ▼
PHP 8.2
   │
   ▼
Authentication / CSRF / Business Rules
   │
   ▼
mysqli
   │
   ▼
MariaDB
```

The project intentionally preserves part of its original architecture while modernizing shared components, security controls, and development tooling.

---

## 🛠️ Tech Stack

### Backend & Database

`PHP 8.2` · `mysqli` · `MariaDB` · `MySQL-compatible SQL`

### Frontend

`HTML5` · `CSS3` · `JavaScript` · `SCSS` · `Materialize CSS` · `jQuery`

### Development & Quality

`Docker` · `Docker Compose` · `GitHub Actions` · `Git`

---

## 🧪 Testing & CI

The project includes automated quality and integration checks executed on `push` and `pull_request`.

```text
Push / Pull Request
        │
        ▼
GitHub Actions
        │
        ├── PHP Syntax Checks
        ├── Security Checks
        ├── Smoke Tests
        └── Integration Tests
                │
                ▼
          MariaDB 11.4
                │
                ▼
        PHP Test Server
```

The integration workflow validates behaviors including:

- customer registration
- password hashing
- customer login
- session persistence
- anonymous admin access blocking
- administrator login
- product creation
- product editing
- product deletion
- database persistence
- CSRF enforcement
- demonstration order creation
- server-side pricing
- correct stock reduction
- order confirmation

Test data is synthetic and removed after execution.

---

## 🐳 Running with Docker

### Requirements

- Docker Desktop
- Docker Compose

Clone the repository:

```bash
git clone https://github.com/leviroiz/presentes-da-cegonha.git
cd presentes-da-cegonha
```

Create the local environment file:

```bash
cp .env.example .env
```

On PowerShell:

```powershell
Copy-Item .env.example .env
```

Configure your local credentials and start the environment:

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

---

## 🕒 Project Evolution

The repository preserves two important stages:

### `v1-academico-2023`

The original version developed during my Technical Degree in Information Technology.

### `main`

The modernized portfolio version, including:

- security improvements
- code reorganization
- Docker environment
- sanitized database
- automated tests
- CI
- technical documentation

This makes it possible to compare the evolution of the project without removing its original academic context.

---

## 👨‍💻 Contribution

The original academic project was developed by two students.

| Area | Contribution |
|---|---|
| Interface and responsiveness | **Carlos Levi** |
| Screen integration | **Carlos Levi** |
| Original backend | Developed collaboratively |
| 2026 security review | **Carlos Levi** |
| Portfolio modernization | **Carlos Levi** |
| Docker environment | **Carlos Levi** |
| Tests and CI | **Carlos Levi** |
| Technical documentation | **Carlos Levi** |

This distinction is intentionally preserved to accurately represent both the original team effort and the later modernization work.

---

## ⚠️ Limitations

This is still an academic project and is not intended to be a production-ready e-commerce platform.

Known limitations include:

- simulated payments
- no payment gateway
- limited multi-item cart persistence
- no password recovery
- no rate limiting
- no production observability
- privacy and regulatory requirements were not designed for real-world deployment

The purpose of the modernization was not to turn the project into a commercial product, but to demonstrate technical evolution and apply practices learned after the original implementation.

---

## 📄 License

This project is available under the [MIT License](LICENSE).
