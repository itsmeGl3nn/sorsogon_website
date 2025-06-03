<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">Headless CMS with Laravel REST API & Vue.js + Vuetify</h2>

---

## 📘 About the Project

This is a **Headless CMS** built using a **Laravel RESTful API** as the backend and a **Vue.js** frontend powered by **Vuetify**. It’s designed for flexibility, performance, and scalability—making it ideal for content-driven applications that require a decoupled architecture.

---

## ⚙️ Tech Stack

### Backend
- Laravel 10+
- Sanctum (API Authentication)
- Eloquent ORM
- Laravel Resources & Policies

### Frontend
- Vue.js 3
- Vuetify 3
- Vue Router + Pinia
- Axios

---

## 📁 Project Structure

### Backend (`/backend`)
- `app/Http/Controllers/Api` – REST controllers
- `routes/api.php` – API endpoints
- `app/Models` – Data models
- `database/migrations` – Database schema
- `app/Http/Resources` – API response formatting

### Frontend (`/frontend`)
- `src/views/` – Page components
- `src/components/` – Reusable UI components
- `src/store/` – Pinia for state management
- `src/router/` – Vue Router setup
- `src/services/api.js` – Axios instance and API calls

---

## 🚀 Getting Started

### Backend (Laravel API)

1. **Install Dependencies**
   ```bash
   composer install
Environment Setup

bash
Copy
Edit
cp .env.example .env
php artisan key:generate
Run Migrations

bash
Copy
Edit
php artisan migrate
Run the Server

bash
Copy
Edit
php artisan serve
Frontend (Vue + Vuetify)
Install Dependencies

bash
Copy
Edit
npm install
Run the Dev Server

bash
Copy
Edit
npm run dev
Configure API Base URL
Update the Axios base URL:

js
Copy
Edit
// src/services/api.js
const API = axios.create({
  baseURL: 'http://localhost:8000/api',
});
🔐 Authentication
Uses Laravel Sanctum for secure token-based authentication.

Login via /api/login returns a token to be stored on the frontend.

Protect API routes using auth:sanctum middleware.

📦 Features
Headless content management

Fully decoupled frontend and backend

CRUD APIs for content types (Posts, Pages, etc.)

Role-based access (Admin, Editor, etc.)

Authentication & session management

Responsive design using Vuetify

📚 API Documentation
All API endpoints are prefixed with /api.

Auth
POST /login – Authenticate user

POST /logout – Revoke token

GET /user – Current user info

Posts
GET /posts – List posts

GET /posts/{id} – Single post

POST /posts – Create post

PUT /posts/{id} – Update post

DELETE /posts/{id} – Delete post

Other resources follow similar CRUD structure.

☁️ Deployment
Backend: Can be deployed on Hostinger VPS, GCP, or AWS EC2.

Frontend: Deploy via Vercel, Netlify, or static assets served by Laravel.

Make sure CORS and production .env settings are properly configured.

🤝 Contributing
Pull requests and issues are welcome! Please follow Laravel and Vue best practices when contributing to the codebase.

🛡 License
This project is licensed under the MIT License.

pgsql
Copy
Edit

Let me know if you want to include example screenshots, database schema diagrams, or setup videos!






You said:
make all in the readme.md 


ChatGPT said:
Sure! Below is the full and complete README.md for your Headless CMS project using Laravel (REST API) and Vue.js with Vuetify, including all documentation in one place—fully formatted and ready to use.

markdown
Copy
Edit
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">Headless CMS with Laravel REST API & Vue.js + Vuetify</h2>

---

## 📘 About the Project

This is a **Headless CMS** built using a **Laravel RESTful API** as the backend and a **Vue.js** frontend powered by **Vuetify**. It’s designed for flexibility, performance, and scalability—making it ideal for content-driven applications that require a decoupled architecture.

---

## ⚙️ Tech Stack

### Backend
- Laravel 10+
- Sanctum (API Authentication)
- Eloquent ORM
- Laravel Resources & Policies

### Frontend
- Vue.js 3
- Vuetify 3
- Vue Router + Pinia
- Axios

---

## 📁 Project Structure

### Backend (`/backend`)
/app
/Http
/Controllers/Api -> RESTful API Controllers
/Models -> Eloquent Models
/routes
api.php -> API Route Definitions
/database
/migrations -> Database Migrations
/app/Http/Resources -> Format API Responses

shell
Copy
Edit

### Frontend (`/frontend`)
/src
/views -> Vue Page Components
/components -> Reusable UI Components
/store -> Pinia State Management
/router -> Vue Router Config
/services/api.js -> Axios API Integration

yaml
Copy
Edit

---

## 🚀 Getting Started

### Backend (Laravel API)

1. **Install dependencies**
   ```bash
   composer install
Set up environment

bash
Copy
Edit
cp .env.example .env
php artisan key:generate
Run database migrations

bash
Copy
Edit
php artisan migrate
Serve the backend

bash
Copy
Edit
php artisan serve
Frontend (Vue + Vuetify)
Install dependencies

bash
Copy
Edit
npm install
Run the frontend app

bash
Copy
Edit
npm run dev
Configure Axios base URL
Edit src/services/api.js:

js
Copy
Edit
import axios from 'axios';

const API = axios.create({
  baseURL: 'http://localhost:8000/api',
  withCredentials: true, // required for Sanctum
});

export default API;
🔐 Authentication (Laravel Sanctum)
Sanctum provides token-based API authentication.

Login endpoint returns a token stored in the frontend (usually localStorage or cookie).

Protect routes using auth:sanctum middleware.

Example Login API Call (frontend):

js
Copy
Edit
API.post('/login', {
  email: 'admin@example.com',
  password: 'password'
});
📦 Features
🔑 Secure authentication with Laravel Sanctum

📝 Full CRUD for content types (posts, pages, etc.)

🔧 Headless architecture — decoupled frontend and backend

🎨 Responsive design with Vuetify

👥 Role-based access control (Admin, Editor, etc.)

🌐 API-first — ready for mobile, web, or external apps

🚀 Optimized for performance, SEO, and accessibility

📚 API Endpoints
All endpoints are prefixed with /api

Auth Routes
Method	Endpoint	Description
POST	/login	Authenticate user
POST	/logout	Revoke session/token
GET	/user	Get current user data

Posts
Method	Endpoint	Description
GET	/posts	List all posts
GET	/posts/{id}	Get single post
POST	/posts	Create a new post
PUT	/posts/{id}	Update a post
DELETE	/posts/{id}	Delete a post

You can extend similar routes for other content types (e.g., Pages, Media, Categories, etc.)

☁️ Deployment
Backend
Can be deployed on:

Hostinger VPS

AWS EC2 / GCP Compute Engine

Laravel Forge or Shared Hosting

Ensure .env is configured for production

Use php artisan config:cache for optimization

Frontend
Deploy to:

Vercel

Netlify

Static build via:

bash
Copy
Edit
npm run build
Or serve directly from Laravel (public folder)

CORS Configuration
Ensure cors.php allows frontend domain:

php
Copy
Edit
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_origins' => ['http://localhost:5173'], // adjust for prod
📸 Screenshots
(Optional section – Add screenshots of your CMS dashboard, editor, or frontend preview)
Example:

<p align="center"> <img src="screenshots/dashboard.png" width="80%" alt="CMS Dashboard Screenshot"> </p>
