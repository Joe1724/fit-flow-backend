```markdown
# 🏋️ FitFlow - Gym Management System API

A robust, full-stack REST API built with **Laravel** to manage modern gym operations. This system handles user authentication, membership subscriptions, class scheduling, booking management, attendance tracking, and payment processing.

## 🚀 Features

-   **Authentication**: Secure Register/Login with Laravel Sanctum (Token-based).
-   **Membership Management**: Admin-created plans (e.g., Gold, Silver) and user subscriptions.
-   **Class Scheduling**: Manage trainers, class capacities, and schedules.
-   **Booking System**: Members can book classes with automated capacity checks.
-   **Attendance System**: Check-in/Check-out functionality (QR, Biometric, Manual).
-   **Payments**: Record transactions and automatically activate subscriptions.
-   **Data Privacy**: Full PII encryption (Name, Email) and secure blind indexing.

## 🛠️ Tech Stack

-   **Framework**: Laravel 11
-   **Language**: PHP 8.2+
-   **Database**: MySQL
-   **API Auth**: Laravel Sanctum

---

## ⚙️ Installation Guide

Follow these steps to set up the project locally.

### 1. Clone the Repository
```bash
git clone [https://github.com/Joe1724/fit-flow-backend.git](https://github.com/Joe1724/fit-flow-backend.git)
cd fit-flow-backend

```

### 2. Install Dependencies

```bash
composer install

```

### 3. Environment Setup

Copy the example environment file and configure your database settings.

```bash
cp .env.example .env

```

Open `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitness_management_system
DB_USERNAME=root
DB_PASSWORD=

```

### 4. Generate Application Key

```bash
php artisan key:generate

```

### 5. Run Migrations & Seeder

This will create all tables (Users, Plans, Classes, Bookings, Attendance, Payments) and seed the Admin user.

```bash
php artisan migrate:fresh --seed

```

### 6. Serve the Application

```bash
php artisan serve

```

The API will be available at: `http://127.0.0.1:8000`

---

## 📚 API Documentation

### **Authentication**

| Method | Endpoint | Description | Auth Required |
| --- | --- | --- | --- |
| `POST` | `/api/register` | Register a new user | ❌ |
| `POST` | `/api/login` | Login and get API Token | ❌ |
| `GET` | `/api/user` | Get current user profile | ✅ |

### **Memberships & Plans**

| Method | Endpoint | Description | Auth Required |
| --- | --- | --- | --- |
| `GET` | `/api/plans` | List all available membership plans | ❌ |
| `POST` | `/api/plans` | Create a new plan (Admin only) | ✅ |
| `POST` | `/api/subscribe` | Create a pending subscription for a plan | ✅ |

### **Classes & Scheduling**

| Method | Endpoint | Description | Auth Required |
| --- | --- | --- | --- |
| `GET` | `/api/classes` | List all gym classes | ❌ |
| `POST` | `/api/classes` | Schedule a new class (Admin only) | ✅ |

### **Bookings**

| Method | Endpoint | Description | Auth Required |
| --- | --- | --- | --- |
| `POST` | `/api/bookings` | Book a spot in a class | ✅ |

### **Attendance (Check-in/Out)**

| Method | Endpoint | Description | Auth Required |
| --- | --- | --- | --- |
| `POST` | `/api/attendance/check-in` | Enter the gym (creates log) | ✅ |
| `POST` | `/api/attendance/check-out` | Exit the gym (updates log) | ✅ |

### **Payments**

| Method | Endpoint | Description | Auth Required |
| --- | --- | --- | --- |
| `POST` | `/api/payments` | Process payment & activate subscription | ✅ |

---

## 🧪 Testing the API (Example Payloads)

**Header for Protected Routes:**
`Authorization: Bearer <your_token_here>`

#### **1. Schedule a Class (Admin)**

`POST /api/classes`

```json
{
    "name": "Yoga Flow",
    "trainer_id": 2,
    "start_time": "2026-02-10 09:00:00",
    "end_time": "2026-02-10 10:00:00",
    "capacity": 20
}

```

#### **2. Book a Class (Member)**

`POST /api/bookings`

```json
{
    "gym_class_id": 1
}

```

#### **3. Check In (Member)**

`POST /api/attendance/check-in`

```json
{
    "method": "qr"
}

```

#### **4. Process Payment**

`POST /api/payments`

```json
{
    "subscription_id": 1,
    "amount": 50.00,
    "payment_method": "credit_card",
    "transaction_id": "TXN_123456789"
}

```

---

## 🛡️ Security

This API implements advanced security measures to protect user data:

* **PII Encryption**: Sensitive fields like **Name** and **Email** are encrypted at rest using Laravel's encryption services (AES-256-CBC). If the database is compromised, user data remains unreadable.
* **Blind Indexing**: Login lookups use a separate SHA-256 `email_hash` column. This allows the system to verify credentials without ever exposing or decrypting the full email list during queries.
* **Access Control**: All private endpoints are protected by **Laravel Sanctum** middleware.
* **Data Integrity**: Strict validation rules prevent double-booking and duplicate payments.

```

```