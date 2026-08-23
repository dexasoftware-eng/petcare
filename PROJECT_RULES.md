# PetGuard (`petcaretw`) - Vibe Coding Rules & Architecture Guidelines

This file ensures that all developers (and their Antigravity AI agents) generate consistent, clean, and conflict-free code.

---

## 🏗️ Tech Stack

- **Backend:** Node.js, Express.js (ES Modules `import/export`)
- **Database:** MongoDB Atlas (Cloud) with Mongoose ODM
- **Frontend:** React (Vite), Tailwind CSS, Lucide React (Icons), Axios, React Router DOM
- **Authentication:** JWT (JSON Web Tokens) with bcryptjs password hashing

---

## 📁 Project Folder Structure

```
petcaretw/
├── backend/                 # Backend Node.js / Express API
│   ├── src/
│   │   ├── config/          # Database & third-party configs (db.js)
│   │   ├── controllers/     # Request handlers & business logic
│   │   ├── middlewares/     # Auth & RBAC validation middlewares
│   │   ├── models/          # Mongoose schemas (User, Pet, HealthRecord, etc.)
│   │   ├── routes/          # Express API route endpoints (/api/v1/...)
│   │   ├── services/        # Business logic & helper services
│   │   ├── utils/           # Helper functions & constants
│   │   └── index.js         # Main server entrypoint
│   ├── .env                 # Secret environment variables (NOT committed to Git)
│   ├── .env.example         # Template for environment variables
│   ├── test-db.js           # DB connection tester
│   └── package.json
├── frontend/                # Frontend Vite React App
│   ├── src/
│   │   ├── assets/          # Static assets & images
│   │   ├── components/      # Reusable UI components (Navbar, Footer, Modals)
│   │   ├── context/         # React Context (Auth, Cart, Pet, Notification)
│   │   ├── hooks/           # Custom React hooks
│   │   ├── pages/           # Route views (Owner, Vet, Shelter, Admin)
│   │   ├── routes/          # App routing & Protected routes
│   │   ├── services/        # Axios API service instances
│   │   ├── utils/           # Frontend helpers
│   │   ├── App.jsx
│   │   └── main.jsx
│   ├── index.html
│   ├── tailwind.config.js
│   └── package.json
├── FurShield_Master_Requirements_Specification.md
├── PROJECT_RULES.md
└── .gitignore
```

---

## 🤝 Collaboration & Git Rules for Two Vibe Coders

1. **Branching Strategy:**
   - Always create a separate branch for any new feature:
     ```bash
     git checkout -b feature/your-feature-name
     ```
   - Never push directly to `main` without checking.

2. **Environment Variables:**
   - Both developers MUST use the shared MongoDB Atlas connection string in their `backend/.env`.
   - Never commit `.env` to Git.

3. **API Conventions:**
   - All backend routes must start with `/api/` (e.g. `/api/auth`, `/api/pets`, `/api/bookings`).
   - Standard JSON responses:
     ```json
     {
       "success": true,
       "message": "Operation successful",
       "data": { ... }
     }
     ```
