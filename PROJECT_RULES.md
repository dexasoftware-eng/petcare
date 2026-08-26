# PetGuard (`petcaretw`) — PHP MVC Architecture & Vibe Coding Rules

This project has been converted from MERN to a **Modern Flat PHP 8.2+ MVC Architecture** tailored for XAMPP (Apache + MariaDB/MySQL).

---

## 🏗️ Technology Stack

- **Server & Backend:** PHP 8.2+, Custom High-Performance MVC Engine, Apache (`mod_rewrite` via `.htaccess`)
- **Database:** MariaDB / MySQL with PDO (Object-Relational Mapping & Migration Engine)
- **Frontend & Styling:** Vanilla HTML5, Bootstrap, FontAwesome 6, Custom Responsive Theme CSS & JS
- **Security:** Bcrypt password hashing, Role-Based Access Control (RBAC), CSRF Token Protection, Input Sanitization & Validation

---

## 📁 Root Project Structure

```
petcaretw/
├── config/              # Configuration (config.php, database.php)
├── core/                # MVC Core Engine (App, Router, Controller, Model, Database, Session, View, Migration, Request, Response)
├── controllers/         # Web & API Request Handlers
├── models/              # Active Record PDO Models
├── middleware/          # Security Guards (Auth, Guest, Role, Csrf)
├── helpers/             # Utility helpers (Auth, Flash, Validator, ViewHelper)
├── views/               # PHP Templates, Layouts (main, dashboard, auth) & Partials
├── migrations/          # 🚀 All Database Schema Migrations (m0001_..., m0002_..., etc.)
├── assets/              # CSS, JS, Images, Icons
├── index.php            # Root Front Controller & Router Entry Point
├── migrate.php          # CLI & Web Database Migration Runner
├── .htaccess            # URL rewrite rules for clean routing
├── .env.example         # Environment template
└── README.md            # Comprehensive project & migrations guide
```

---

## ⚡ Mandatory Database Migrations Rule

1. **Never edit database tables directly in phpMyAdmin or raw SQL.**
2. Whenever any new table or column is required, always create a migration file in `migrations/` named `mXXXX_your_change.php` extending `Core\Migration`.
3. Apply migrations using `php migrate.php` or `http://localhost/petcaretw/migrate.php`.
