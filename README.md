# 🐾 PetGuard (`petcaretw`) — Enterprise Pet Care PHP MVC Web Application

**PetGuard** is an enterprise-grade **Pet Healthcare, Veterinary Practice Management, Multi-Shelter Animal Rescue, and Care Platform** built in a **Modern PHP 8.2+ MVC Architecture** for XAMPP (Apache + MariaDB/MySQL).

---

## 🏗️ Project Architecture & Folder Structure

All core components reside directly in the root directory for immediate and smooth execution on XAMPP:

```text
petcaretw/
├── config/              # Application & Database Configuration
│   ├── config.php       # App URL, Name (PetGuard), Session settings
│   └── database.php     # MariaDB / MySQL PDO Connection Parameters
├── core/                # Custom High-Performance MVC Engine
│   ├── App.php          # Application Bootstrapper & Autoloader
│   ├── Router.php       # Regex URL Router (GET, POST, Dynamic Params & Middleware)
│   ├── Controller.php   # Base Controller (render, json, redirect, validation)
│   ├── Model.php        # Base Model (ActiveRecord / PDO Query Builder)
│   ├── Database.php     # Singleton PDO Connection Manager
│   ├── Request.php      # HTTP Request Data & Sanitization Helper
│   ├── Response.php     # HTTP Response (JSON, Redirects, Headers)
│   ├── View.php         # Template Engine with Layouts & Partials
│   ├── Session.php      # Session & CSRF Security Protection
│   ├── Migration.php    # Abstract Migration Class (up / down)
│   └── MigrationRunner.php # Migration Orchestrator Engine
├── controllers/         # Web & API Request Handlers
│   ├── HomeController.php      # Landing, About, Services, How We Work, History, Pricing, Gallery
│   ├── AuthController.php      # 4-Role Authentication, Registration, Password Reset
│   ├── PortalController.php    # Unified Portal Dashboard (PetOwner, Vet, Shelter, Admin)
│   ├── ShopController.php      # Marketplace catalog, Category filters, Product details
│   ├── CartController.php      # Shopping cart management (Add, Update, Remove, Clear)
│   ├── CheckoutController.php  # Order processing & Order confirmation
│   ├── BlogController.php      # Veterinary articles & Comments
│   ├── ServiceController.php   # Clinical services catalog & details
│   ├── TeamController.php      # Staff profiles & competencies
│   ├── ContactController.php   # Contact inquiries submission
│   └── ApiController.php       # REST JSON Endpoints
├── models/              # Database Entity Models
│   ├── User.php
│   ├── Pet.php
│   ├── Appointment.php
│   ├── VeterinarianProfile.php
│   ├── ShelterProfile.php
│   ├── Product.php
│   ├── Category.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Blog.php
│   ├── BlogComment.php
│   ├── Service.php
│   ├── Team.php
│   ├── Inquiry.php
│   └── AuditLog.php
├── views/               # Clean & Distinct View Templates
│   ├── home/            # Home Page (All 11 rich sections)
│   ├── pages/           # About, Services, How We Work, History, Pricing, Gallery, Contact
│   ├── shop/            # Products Catalog, Product Details, Cart, Checkout, Success
│   ├── blog/            # Articles Listing & Article Details with Comments
│   ├── auth/            # Login, Owner Register, Vet Register, Shelter Register
│   ├── portal/          # Unified Portal Dashboard (role-differentiated)
│   │   └── index.php    # Single clean dynamic dashboard view
│   ├── layouts/         # Layout shells
│   │   ├── main.php     # Main website shell (Header, Footer, Navigation)
│   │   ├── portal.php   # Portal dashboard layout with sidebar
│   │   └── auth.php     # Authentication shell
│   └── partials/        # Reusable view components (Header, Footer)
├── migrations/          # Incremental Database Schema & Seed Migrations
│   ├── m0001_create_users_table.php
│   ├── m0002_create_profiles_table.php
│   ├── m0003_create_categories_table.php
│   ├── m0004_create_products_table.php
│   ├── m0005_create_orders_and_items_table.php
│   ├── m0006_create_blogs_and_comments_table.php
│   ├── m0007_create_services_table.php
│   ├── m0008_create_teams_table.php
│   ├── m0009_create_inquiries_table.php
│   ├── m0010_create_pets_table.php
│   ├── m0011_create_vaccines_and_appointments_table.php
│   ├── m0012_create_audit_logs_table.php
│   ├── m0013_seed_default_admin_and_content.php
│   ├── m0014_update_owner_role_to_petowner.php
│   └── m0015_update_demo_emails_to_petguard.php
├── middleware/          # Security & Route Access Guards
│   ├── AuthMiddleware.php
│   ├── GuestMiddleware.php
│   ├── OwnerMiddleware.php
│   ├── VetMiddleware.php
│   ├── ShelterMiddleware.php
│   ├── AdminMiddleware.php
│   └── CsrfMiddleware.php
├── helpers/             # Utility Helpers
│   ├── Auth.php
│   ├── Flash.php
│   └── ViewHelper.php
├── assets/              # CSS, JS, Fonts, Images & Icons
├── index.php            # Master Front Controller & Route Registry
└── migrate.php          # CLI & Browser Database Migration Runner
```

---

## ⚡ Database Migrations System

To execute all migrations automatically:

```bash
# Via CLI:
php migrate.php

# Or via Browser:
http://localhost/petcaretw/migrate
```

---

## 👥 Platform User Roles & Test Credentials

| Role | Role Title | Email | Password | Access Portal |
|---|---|---|---|---|
| **👑 Admin** | Administrator | `admin@petguard.com` | `Password@123` | `http://localhost/petcaretw/portal` |
| **👨‍⚕️ Vet** | Veterinarian (Doctor) | `vet@petguard.com` | `Password@123` | `http://localhost/petcaretw/portal` |
| **🏠 Shelter** | Animal Rescue Sanctuary | `shelter@petguard.com` | `Password@123` | `http://localhost/petcaretw/portal` |
| **🐾 PetOwner** | Pet Owner / Parent | `owner@petguard.com` | `Password@123` | `http://localhost/petcaretw/portal` |

---

## 🌐 Public Website Routes

- **Home Page**: `http://localhost/petcaretw/`
- **About Us**: `http://localhost/petcaretw/about`
- **Services**: `http://localhost/petcaretw/services`
- **How We Work**: `http://localhost/petcaretw/how-we-works`
- **History**: `http://localhost/petcaretw/history`
- **Pricing Packages**: `http://localhost/petcaretw/pricing-packages`
- **Photo Gallery**: `http://localhost/petcaretw/photo-gallery`
- **Shop / Products**: `http://localhost/petcaretw/our-products`
- **Shopping Cart**: `http://localhost/petcaretw/shop-cart`
- **Checkout**: `http://localhost/petcaretw/cart-checkout`
- **Blog & News**: `http://localhost/petcaretw/our-blog`
- **Contact & Inquiries**: `http://localhost/petcaretw/contact`
- **User Login**: `http://localhost/petcaretw/login`
