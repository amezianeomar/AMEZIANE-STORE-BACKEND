# AMEZIANE-STORE (Atelier 10: God-Tier Edition) 🎮✨

Welcome to **AMEZIANE-STORE**, a cutting-edge e-commerce platform built with a **Laravel API** backend and a **React** frontend. This project represents the pinnacle of "Atelier 10", featuring a decoupled architecture and a "God-Tier" Cyberpunk/Sci-Fi User Interface.

## 🚀 Features

### Frontend (React)

* **God-Tier UI**: A fully immersive Cyberpunk aesthetic with Neon Cyan/Purple accents, glassmorphism panels, and holographic effects.
* **Responsive Design**: Optimized for all devices, from massive gaming monitors to mobile comms links.
* **Search & Filters**:
  * Real-time product search by name.
  * Filtering by **Category** and **Max Price**.
* **Pagination**: Smooth navigation with "Scroll-to-Top" behavior.
* **Product Management**:
  * **FilComp**: Browse the artifact catalogue with HUD-style controls.
  * **AddComp**: Upload new artifacts with drag-and-drop visuals and seamless API integration.

### Backend (Laravel API)

* **REST API**: Fully decoupled API serving JSON responses.
* **Advanced Querying**:
  * `GET /api/products?page=X`: Paginated results (6 per page).
  * `GET /api/products?search=...`: Search by product name.
  * `GET /api/products?category=...`: Filter by category.
  * `GET /api/products?max_price=...`: Filter by budget.
* **Cloudinary Integration**: Secure image uploads to the specific `ameziane_store_api_test` folder.
* **Security**: Strict validation and CORS configuration for development stability.

## 🛠️ Technology Stack

* **Frontend**: React.js, Axios, CSS3 (Variables, Animations, Clip-Paths).
* **Backend**: Laravel 11, Sanctum (Ready), PHP 8.2+.
* **Database**: MySQL / MariaDB.
* **Storage**: Cloudinary.

## 📦 Installation & Setup

### 1. Backend Setup (Laravel)

```bash
cd atelier10
composer install
cp .env.example .env
# Configure database in .env
php artisan key:generate
php artisan migrate
php artisan serve
```

*API will run on: `http://localhost:8000`*

### 2. Frontend Setup (React)

```bash
cd client
npm install
npm start
```

*Frontend will run on: `http://localhost:3000`*

## 🎨 UI Showcase

The interface features:

* **Orbitron/Rajdhani Fonts**: For that futuristic data-terminal feel.
* **Neon Glows**: Box-shadows that pulse and breathe.
* **Angled UI**: Clip-path styling (with mobile safety fallbacks) for a tactical look.

---

**Lead Tech / QA**: Agt. Antigravity
*Code Audited & Compliant: 2026-01-28*
