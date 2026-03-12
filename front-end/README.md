# Asset Manager Frontend

This is the **frontend application** for the Asset Manager System.
It is built using **Vue.js** and communicates with the backend API to manage and monitor organizational assets.

The application provides an intuitive interface for users to view, manage, and track assets.

---

## Tech Stack

- **Framework:** Vue.js
- **Build Tool:** Vite
- **Styling:** Tailwind CSS
- **Routing:** Vue Router
- **State Management:** Pinia
- **HTTP Client:** Axios

---

## Features

- User authentication
- Asset listing and management
- Role-based UI (Admin / User)
- Asset creation and editing
- Responsive UI
- API integration with Laravel backend

---

## Installation

### Install dependencies

```bash
npm install
```

---

### Run development server

```bash
npm run dev
```

The application will run at:

```
http://localhost:5173
```

---

## Build for Production

```bash
npm run build
```

---

## Environment Configuration

Create a `.env` file if needed for API configuration.

Example:

```
VITE_API_URL=http://localhost:8000/api
```

---

## Project Structure

```
src/
 ├── components
 ├── pages
 ├── router
 ├── stores
 ├── services
 └── assets
```

---

## Backend API

This frontend communicates with the **Laravel backend API**.

See the backend folder for API setup instructions.
