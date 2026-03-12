# Asset Manager Backend

This is the **backend API** for the Asset Manager System.
It is built using **Laravel 12** and provides RESTful endpoints for managing organizational assets.

The backend handles authentication, asset management, and secure communication with the frontend application.

---

## Tech Stack

- **Framework:** Laravel 12
- **Language:** PHP 8+
- **Database:** MySQL
- **Authentication:** Laravel Sanctum
- **API Type:** RESTful API

---

## Features

- User authentication using Laravel Sanctum
- Asset creation, update, and deletion
- Role-based access control (Admin / User)
- Secure API endpoints
- Database migrations and seeders
- Designed for SPA frontend integration

---

## Installation

### Install dependencies

```bash
composer install
```

### Setup environment file

```bash
cp .env.example .env
```

Update your database configuration in `.env`.

---

### Generate application key

```bash
php artisan key:generate
```

---

### Run migrations

```bash
php artisan migrate
```

---

### Start development server

```bash
php artisan serve
```

The API will run at:

```
http://127.0.0.1:8000
```

---

## Authentication

Authentication is handled using **Laravel Sanctum**.

Protected routes require an API token in the request header:

```
Authorization: Bearer {token}
```

---

## API Routes

Example endpoints:

| Method | Endpoint         | Description       |
| ------ | ---------------- | ----------------- |
| POST   | /api/login       | Authenticate user |
| GET    | /api/assets      | Retrieve assets   |
| POST   | /api/assets      | Create asset      |
| PUT    | /api/assets/{id} | Update asset      |
| DELETE | /api/assets/{id} | Delete asset      |

---

## Related Projects

This backend is part of a **monorepo** that also contains the frontend application.

See the root README for full project documentation.
