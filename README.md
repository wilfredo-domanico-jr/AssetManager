# 🏢 Asset Management System

[![Laravel](https://img.shields.io/badge/Laravel-12-red)](https://laravel.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-3-42b883)](https://vuejs.org/)
[![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-3.3-blue)](https://tailwindcss.com/)
[![ApexCharts](https://img.shields.io/badge/ApexCharts-3-orange)](https://apexcharts.com/)
[![Axios](https://img.shields.io/badge/Axios-1.5-lightblue)](https://axios-http.com/)
[![Pinia](https://img.shields.io/badge/Pinia-2-purple)](https://pinia.vuejs.org/)
[![Sanctum](https://img.shields.io/badge/Sanctum-2-cyan)](https://laravel.com/docs/sanctum)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

---

## 📌 Project Description

**Asset Management System** is a modern web application built with a **Laravel API backend** and **Vue.js frontend**.

It allows organizations to efficiently track and manage assets across their lifecycle, including:

- Asset deployment tracking
- Depreciation and lifecycle reporting
- Inventory summaries
- Automated weekly email notifications
- Role-based access control

The frontend is built with **Vue.js**, **Pinia**, **Axios**, and **Tailwind CSS**, while **ApexCharts** is used for data visualization.

---

## 📸 Screenshot

<p align="center">
  <img src="screenshot_new.png" alt="Asset Management Screenshot" width="700">
</p>

---

## ⚡ Features

- Asset lifecycle tracking
- Automated depreciation reports
- Inventory management
- Weekly email notifications
- Role-based access control (Laravel Sanctum)
- Responsive UI with Tailwind CSS
- Interactive dashboards with ApexCharts
- RESTful API architecture

---

## 🐳 Docker Setup (Recommended)

This project includes a full Docker development environment:

- Laravel backend API
- Vue.js frontend (hot reload enabled)
- MySQL database

---

### 📁 Project Structure

```
AssetManager/
├── back-end/
├── front-end/
└── docker-compose.yml
```

---

### 🚀 Run with Docker

#### Build and start containers

```bash
docker-compose up --build
```

#### Run in background

```bash
docker-compose up -d --build
```

#### Stop containers

```bash
docker-compose down
```

---

### 🌐 Access URLs

| Service               | URL                                            |
| --------------------- | ---------------------------------------------- |
| Frontend (Vue)        | [http://localhost:5173](http://localhost:5173) |
| Backend (Laravel API) | [http://localhost:8000](http://localhost:8000) |
| MySQL                 | localhost:3306                                 |

---

## 🛠️ Traditional Installation (Without Docker)

### Backend (Laravel)

```
git clone https://github.com/wilfredo-domanico-jr/AssetManager.git
cd AssetManager/back-end
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

### Frontend (Vue.js)

```
cd ../front-end
npm install
npm run dev
```

---

## 🧰 Technologies Used

- Laravel 12
- Vue.js 3
- Tailwind CSS
- Pinia
- Axios
- ApexCharts
- MySQL
- Docker
- PHP 8+
- Node.js / Vite

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).


