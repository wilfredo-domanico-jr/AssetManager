# Asset Management System 🏢

[![Laravel](https://img.shields.io/badge/Laravel-10-red)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8-blue)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-3.3-blue)](https://tailwindcss.com/)
[![ApexCharts](https://img.shields.io/badge/ApexCharts-3-orange)](https://apexcharts.com/)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

---

## Project Description

**Asset Management System** is a responsive web-based platform built with **Laravel, MySQL, Tailwind CSS, and ApexCharts**.  
It helps organizations efficiently track and manage assets across their entire lifecycle. The system features asset deployment tracking, depreciation and lifecycle reporting, inventory summaries, and automated weekly email notifications. Role-based access ensures secure usage, while interactive charts and a modern interface improve visibility, efficiency, and decision-making across departments.

---

## Screenshot

<p align="center">
  <img src="public/images/StockTrackLogo.png" alt="Asset Management Screenshot" width="700">
</p>

---

## Features

- Track organizational assets throughout their lifecycle.
- Automatic depreciation and lifecycle reports.
- Inventory summaries for better visibility.
- Automated weekly email notifications.
- Role-based access control for secure management.
- Responsive design with Tailwind CSS.
- Interactive charts with ApexCharts.
- Built with Laravel and MySQL for reliable backend operations.

---

## Installation

1. **Clone the repository**

```bash
git clone https://github.com/wilfredo-domanico-jr/AssetManagementSystem.git
cd AssetManagementSystem
```

2. **Install PHP dependencies via Composer**

```bash
composer install
```

3. **Copy `.env.example` to `.env` and configure your environment variables**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Set up the database**

```bash
php artisan migrate
php artisan db:seed
```

5. **Serve the application**

```bash
php artisan serve
```

---

## Usage

1. Open the application in your browser at `http://127.0.0.1:8000`.
2. Log in with an admin account or create a new user.
3. Add, track, and manage assets.
4. Generate reports, view charts, and receive automated notifications.

---

## Technologies & Libraries

- **Laravel** – PHP web framework
- **MySQL** – Relational database
- **Tailwind CSS** – Responsive frontend design
- **ApexCharts** – Interactive charts
- **PHP 8+** – Backend scripting
- **Composer** – Dependency management
- **Email notifications** – Automated reporting

---

## License

This project is licensed under the [MIT License](LICENSE).
