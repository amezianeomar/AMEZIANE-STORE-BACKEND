# AMEZIANE-STORE (Atelier 10: God-Tier Edition) 🎮✨

**System Status**: `ONLINE` | **Version**: `2.1.0` | **Theme**: `Cyberpunk/Neon`

Welcome to **AMEZIANE-STORE**, the "God-Tier" e-commerce platform. This project creates a fully immersive, futuristic shopping experience using **Laravel** (Backend/Blade) and **Alpine.js/Tailwind** (Frontend interactions).

> **AI CONTEXT**: This project structure uses Laravel 10+ conventions. Blade templates (`resources/views`) drive the UI. Auth is handled via standard `Auth::routes()` with custom "Angel Protocol" styling. Role-based access control is implemented via `isAdmin()` helper on the User model and `AdminUserMiddleware`.

---

## 🚀 Key Features & Updates (Latest)

### 1. **Angel Protocol (Authentication)**

* **System Access**: Renamed "Connexion" to "SYSTEM ACCESS" to match the lore.
* **Neon Login**: Fully responsive, borderless-mobile design with a `90%` width fluid layout.
* **Registration**: A completely custom "Angel Protocol Initiation" page replacing the default Laravel form, featuring:
  * Holographic/Neon styling.
  * Thematic labels: "Identity" (Name), "Comms Link" (Email), "Secure Passcode" (Password).

### 2. **Access Control (God Mode vs. Angel Mode)**

* **Admins ("Gods")**:
  * Exclusive "GOD PORTAL" menu item with neon pulse effect.
  * "QUIT THE PORTAL" dropdown for secure session termination.
  * Full CRUD access to products and dashboard.
* **Users ("Angels")**:
  * "ANGEL PORTAL" menu item.
  * Product details (`/produits/{id}`) are accessible.
* **Guests**:
  * Can browse categories (`/produits/{cat}`).
  * **Protected**: Attempting to view Product Details (`/produits/{id}`) redirects to the System Access (Login) page.

### 3. **Navigation Architecture**

* **Menu**: `Menu.blade.php` dynamically renders links based on `Auth::guest()`, `Auth::user()->isAdmin()`.
* **Mobile**: Fully responsive mobile menu with matched thematic elements.

---

## 🛠️ Technology Stack

| Component | Tech | Details |
| :--- | :--- | :--- |
| **Backend** | **Laravel 10+** | MVC Architecture, Eloquent ORM, Middleware Protection. |
| **Frontend** | **Blade Templates** | Server-side rendering. |
| **Styling** | **Tailwind CSS** | Utility-first, heavily customized with Neon colors (`brand-neon`, `brand-magenta`). |
| **Interactivity** | **Alpine.js** | Lightweight JS for Dropdowns and Mobile Menus. |
| **Database** | **MySQL** | Standard relational schema. |

---

## 📂 Project Structure (AI Guide)

* `app/Models/User.php`: Contains the `isAdmin()` helper. Roles are defined as constants (`ROLE_ADMIN`, `ROLE_USER`).
* `routes/web.php`:
  * **Public**: `produits/{cat}` (Categories).
  * **Protected (Auth)**: `produits/{id}` (Details) - *Higher Precedence than Public*.
  * **Admin**: `/admin/*` group protected by `adminuser` middleware.
* `resources/views/auth/`: Contains the customized `login.blade.php` and `register.blade.php`.
* `resources/views/Menu.blade.php`: The central navigation hub with role logic.

---

## 📦 Installation & Setup

### 1. Backend Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### 2. Frontend Build

```bash
npm install
npm run dev
```

---

## 🔮 Future Improvements

* **User Dashboard**: Expand "Angel Portal" to include order history and profile settings.
* **Admin Analytics**: Add real-time sales tracking to the "God Portal".
* **Wishlist System**: Allow Angels to save artifacts for later.

---

**Lead Architect**: AMEZIANE OMAR
*System Last Verified: 2026-02-02*
