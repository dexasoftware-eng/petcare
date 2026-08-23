# 🐾 PetGuard — Advanced Pet Care & Healthcare Ecosystem

PetGuard is an enterprise-grade platform unifying **Pet Owners**, **Veterinarians**, **Animal Shelters**, and **Administrators** into a single modern MERN stack application.

---

## 🏗️ Tech Stack

- **Backend:** Node.js, Express.js (ES Modules), MongoDB Atlas, Mongoose ODM
- **Frontend:** React 18, Vite, Tailwind CSS, Lucide Icons, Axios, React Router DOM
- **Authentication:** JWT (JSON Web Tokens) with bcryptjs password hashing

---

## 📁 Project Structure

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
│   ├── .env.example         # Template for environment variables
│   ├── test-db.js           # DB connection tester
│   └── package.json
├── frontend/                # Frontend Vite React App
│   ├── src/
│   │   ├── assets/          # Static assets & images
│   │   ├── components/      # Reusable UI components
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

## 🚀 Getting Started

### 1. Backend Setup
```bash
cd backend
npm install
# Set up your .env file from .env.example
npm run dev
```

### 2. Frontend Setup
```bash
cd frontend
npm install
npm run dev
```
