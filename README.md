# 🔐 Full Stack Authentication System (CodeIgniter + React)

## 🚀 Project Overview

This is a full-stack authentication system built using **CodeIgniter (Backend)** and **ReactJS (Frontend)**.
It includes secure user authentication using **JWT (JSON Web Token)**, role-based access control, and relational database management.

---

## ✨ Features

* User Registration & Login APIs
* JWT Token-based Authentication
* Role-based Routing (User / Teacher)
* Protected APIs using Middleware
* 1-1 Relational Database (User ↔ Teacher)
* Teacher Dashboard with Data Table
* Clean and Responsive UI

---

## 🛠️ Tech Stack

* **Backend:** CodeIgniter 4 (PHP)
* **Frontend:** ReactJS
* **Database:** MySQL
* **Authentication:** JWT (JSON Web Token)

---

## 📂 Project Structure

```
Assinment/
├── backend/        # CodeIgniter API
├── frontend/       # React Application
├── database/       # Database export file
│   └── db.sql
├── README.md
```

---

## ⚙️ Setup Instructions

###  Database Setup

1. Open phpMyAdmin
2. Create a database (e.g., `auth_db`)
3. Import file:

```
database/db.sql
```

---

### Backend Setup (CodeIgniter)

```bash
cd backend
composer install
php spark serve
```

👉 Backend will run on:

```
http://localhost:8080
```

---

### Frontend Setup (React)

```bash
cd frontend
npm install
npm start
```

👉 Frontend will run on:

```
http://localhost:3000
```

---

## Authentication Flow

1. User registers using `/register`
2. User logs in via `/login`
3. JWT token is generated and stored in localStorage
4. Token is sent in headers for protected APIs:

```
Authorization: Bearer <token>
```

---

## Database Schema

### auth_user Table

* id
* email
* first_name
* last_name
* password
* role

### teachers Table

* id
* user_id (Foreign Key)
* university_name
* gender
* year_joined

---

##  API Endpoints

| Method | Endpoint  | Description                  |
| ------ | --------- | ---------------------------- |
| POST   | /register | Register new user            |
| POST   | /login    | Login user                   |
| GET    | /teachers | Get teacher data (Protected) |

---

## Security Features

* Password hashing using `password_hash()`
* JWT-based authentication
* Protected routes using middleware
* Token validation for API access

---

## Key Highlights

* Clean MVC architecture (CodeIgniter)
* React-based dynamic UI
* Secure authentication system
* Real-world project structure

---

This project is built as part of a full-stack developer assignment and demonstrates real-world authentication and API integration.
