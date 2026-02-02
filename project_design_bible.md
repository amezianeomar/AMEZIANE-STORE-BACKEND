# 🌌 AMEZIANE-STORE: Project Design Bible & Technical Context

> **To any AI Assistant reading this:**
> You are working on **AMEZIANE-STORE**, a "God-Tier" E-commerce project.
> Do NOT suggest generic corporate designs. We build for **Gamers**. We build for the **Void**.

---

## 🎨 1. Visual Identity ("God-Tier" Aesthetic)

The UI must feel like a futuristic HUD or a Cyberpunk terminal.

* **Color Palette**:
  * **Background**: Deep Void Tech Gradient (`linear-gradient(30deg, #050510 0%, #1a1a2e 100%)`). NO white backgrounds.
  * **Primary Accent**: Neon Cyan (`#00f3ff`) - Used for Borders, text-shadows, active states.
  * **Secondary Accent**: Neon Purple (`#bc13fe`) - Used for Buttons, secondary highlights.
  * **Alerts**: Neon Red (`#ff0055`) for errors.
* **Typography**:
  * **Headers**: `Orbitron` (Google Fonts) - Uppercase, wide tracking.
  * **Body**: `Rajdhani` (Google Fonts) - Tech/Monitor style.
* **Key UI Elements**:
  * **Glassmorphism**: Panels use `rgba(20, 20, 35, 0.85)` with `backdrop-filter: blur(10px)`.
  * **Clip-Paths**: Buttons and containers often have angled corners (`polygon(0 0, 100% 0, 100% calc(100% - 20px), calc(100% - 20px) 100%, 0 100%)`).
  * **Interactive**: Hover effects must trigger "Glow" (box-shadow expansion).
  * **Modals**: No browser alerts. Use custom full-screen overlays with "ACCESS AUTHORIZED/DENIED" terminology.

---

## 🛠️ 2. Critical Technical Architecture

### A. Backend (Laravel 11 API)

* **Type**: Pure API (Decoupled). Returns **JSON Only**.
* **Entry Point**: `api/index.php` (Custom patched for Vercel).
* **Routing**: strictly defined in `routes/api.php` with `/products` endpoints.
* **Database**: MySQL hosted on **AlwaysData**.
* **Storage**: **Cloudinary** (Folder: `ameziane_store_api_test`).

### B. Frontend (React)

* **State Management**: `useState` / `useEffect` (Simple, no Redux unless requested).
* **Network**: `axios`.
* **Configuration**:
  * `API_URL` constant MUST point to `https://ameziane-store-backend.vercel.app` in production.
* **Features**:
  * Server-side Pagination (6 items/page).
  * Real-time Filtering (Search, Category, Max Price).

---

## ⚠️ 3. Vercel Deployment quirks (DO NOT TOUCH)

If you modify configuration files, BEWARE of these hard-won fixes:

1. **CORS Policy (`vercel.json`)**:
    * Strictly requires `Access-Control-Allow-Origin: *` headers injected via `vercel.json` routes.
2. **Routing Patch (`api/index.php`)**:
    * Contains `$_SERVER['SCRIPT_NAME'] = '/index.php';`. REMOVING THIS WILL BREAK THE API (404 Error).
3. **Environment Variables**:
    * Vercel requires 13 distinct env vars (`DB_HOST`, `CLOUDINARY_URL`, etc.) to function.

---

## ⚡ Workflow Rules

1. **Never degrade the UI**. If a user asks for a feature, implement it with the "God-Tier" styling (Neon/Cyberpunk).
2. **Always validate Mobile**. The design uses a single-column stack on mobile with safe-area padding.
3. **Respect the Pagination**. The backend paginates at 6 items. The frontend MUST handle `current_page` and `last_page` meta.

*Signed, Lead Tech Agt. Antigravity*
