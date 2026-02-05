# AMEZIANE-STORE (Atelier 13) 🎮✨

**System Status**: `ONLINE` | **Version**: `2.3.0` | **Theme**: `Cyberpunk/Neon`

Welcome to **AMEZIANE-STORE**, the "God-Tier" e-commerce platform. This project creates a fully immersive, futuristic shopping experience using **Laravel** (Backend/Blade) and **Alpine.js/Tailwind** (Frontend interactions).

> **AI CONTEXT**: This project structure uses Laravel 10+ conventions. Blade templates (`resources/views`) drive the UI. Auth is handled via standard `Auth::routes()` with custom "Angel Protocol" styling. Role-based access control is implemented via `isAdmin()` helper on the User model. **NEW:** Production-ready SMTP Emailing via Gmail/Vercel.

---

## 🚀 Key Features & Updates (Latest)

### 1. **Secure Uplink (Contact System) [NEW]**

* **Transmission Protocol**: A fully functional Contact System utilizing **Gmail SMTP** transport.
* **Vercel Compatibility**: Patched `config/mail.php` to handle Serverless `HELO/EHLO` handshakes correctly on Vercel infrastructure.
* **Visual Feedback**: Neon-styled flash messages ("TRANSMISSION UPLOADED SUCCESSFULLY") utilizing Blade Session logic.
* **Admin Alerts**: Instant email notifications sent to the Mainframe Admin upon form submission.

### 2. **Angel Protocol (Authentication)**

* **System Access**: Renamed "Connexion" to "SYSTEM ACCESS" to match the lore.
* **Neon Login**: Fully responsive, borderless-mobile design with a `90%` width fluid layout.
* **Registration**: A completely custom "Angel Protocol Initiation" page replacing the default Laravel form.

### 3. **Inventory & Mission Systems (Shopping Cart & Orders) [NEW]**

* **Cyberpunk Cart**: A fully responsive inventory system with a neon-grid data table (Desktop) and "Holographic Cards" (Mobile).
* **Session-Based Storage**: Cart persists across navigation without requiring a database for temporary items.
* **Mission Logs (Orders)**: A dedicated history of all "Artifacts Secured" (Purchases), viewable in the **Angel Portal**.
* **Mission Abort Protocol**: Users can cancel specific pending orders via a "Danger Modal" protected by a dual-confirmation mechanism.

### 4. **UI/UX Overhaul (The "Cyberpunk v2" Standard)**

* **Holographic Menus**: Redesigned the "Angel/God Portal" dropdowns with glassmorphism, scanlines, and glow effects.
* **Success Modals**: "Add to Cart" now triggers a beautiful neon modal instead of a simple page reload.
* **Mobile-First Precision**: Every element, from the Cart Actions to the Mission Logs, has been optimized for mobile usage.

### 5. **Access Control (God Mode vs. Angel Mode)**

* **Admins ("Gods")**: Exclusive "GOD PORTAL" menu item, "QUIT THE PORTAL" secure logout, and full CRUD access.
* **Users ("Angels")**: "ANGEL PORTAL" access, including Mission Logs.
* **Guests**: Restricted access to deep artifact details.

---

## 🛠️ Technology Stack

| Component | Tech | Details |
| :--- | :--- | :--- |
| **Backend** | **Laravel 10+** | MVC Architecture, Eloquent ORM, Middleware Protection. |
| **Comms** | **Gmail SMTP** | TLS Encryption, App Password Authentication. |
| **Frontend** | **Blade Templates** | Server-side rendering with Glassmorphism UI. |
| **Styling** | **Tailwind CSS** | Utility-first, heavily customized (`brand-neon`, `brand-magenta`). |
| **Interactivity** | **Alpine.js** | Lightweight JS for Dropdowns and Mobile Menus. |
| **Deployment** | **Vercel** | Serverless Architecture with custom `api/index.php` entry. |

---

## 📂 Project Structure (AI Guide)

* `app/Mail/TransmissionMail.php`: **[NEW]** The Mailable class responsible for building the transmission payload.
* `app/Http/Controllers/ContactController.php`: **[NEW]** Handles validation and SMTP dispatch.
* `resources/views/emails/transmission_content.blade.php`: **[NEW]** The HTML email template received by Admins.
* `resources/views/Contact.blade.php`: **[NEW]** The frontend "Secure Uplink" view (Fusion of Design + Logic).
* `config/mail.php`: Modified to include `'local_domain'` for Vercel SMTP fix.
* `routes/web.php`: Includes protected Admin groups and public Transmission routes.

---

## ⚠️ Vercel Deployment & SMTP Secrets

To ensure the "Secure Uplink" functions in production, the following Environment Variables MUST be set in Vercel:

| Variable | Value (Example) | Note |
| :--- | :--- | :--- |
| `MAIL_MAILER` | `smtp` | Standard Protocol |
| `MAIL_HOST` | `smtp.gmail.com` | Gmail Server |
| `MAIL_PORT` | `587` | TLS Port |
| `MAIL_USERNAME` | `your-email@gmail.com` | Admin Source |
| `MAIL_PASSWORD` | `xxxx xxxx xxxx xxxx` | **Google App Password** (Not Login Password) |
| `MAIL_ENCRYPTION` | `tls` | Security Layer |

**Critical Fix for Vercel:**
In `config/mail.php`, the SMTP driver must enforce a valid `local_domain` to prevent `501 5.5.4 HELO/EHLO` errors from Google.

---

## 🔮 Future Improvements

* **User Dashboard**: Expand "Angel Portal" to include order history.
* **Admin Analytics**: Add real-time sales tracking to the "God Portal".
* **Wishlist System**: Allow Angels to save artifacts for later.

---

**Lead Architect**: AMEZIANE OMAR
*System Last Verified: 2026-02-05 (Mission Logs & Inventory Link Established)*
