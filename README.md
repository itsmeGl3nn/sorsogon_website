<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">Headless CMS with Laravel REST API & Vue.js + Vuetify</h2>

---

## 📘 About the Project

This is a **Headless CMS** built using a **Laravel RESTful API** for the backend and a **Vue.js** frontend powered by **Vuetify**. It's designed to be fast, scalable, and flexible — ideal for content-driven applications that benefit from a decoupled architecture.

---

## ⚙️ Tech Stack

### Backend
- Laravel 10+
- JWT Authentication (`tymon/jwt-auth`)
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


### Frontend (`/frontend`)
/src
/views -> Vue Page Components
/components -> Reusable UI Components
/store -> Pinia State Management
/router -> Vue Router Config
/services/api.js -> Axios API Integration

yaml


---

## 🚀 Getting Started

### Backend (Laravel API)

1. **Install dependencies**
   ```bash
   composer install
Set up environment

bash

cp .env.example .env
php artisan key:generate
Run database migrations

bash

php artisan migrate
Generate JWT secret

bash

php artisan jwt:secret
Serve the backend

bash

php artisan serve
Frontend (Vue + Vuetify)
Install dependencies

bash

npm install
Run the frontend app

bash

npm run dev
Configure Axios base URL
Edit src/services/api.js:

js

import axios from 'axios';

const API = axios.create({
  baseURL: 'http://localhost:8000/api',
});

export default API;
🔐 Authentication (JWT)
This project uses JWT (JSON Web Token) for API authentication.

After logging in, a token is returned and stored (e.g. in localStorage)

Token is included in the Authorization header of protected requests

Example Login API Call js


API.post('/login', {
  email: 'admin@example.com',
  password: 'password'
}).then(response => {
  const token = response.data.token;
  localStorage.setItem('token', token);
  API.defaults.headers.common['Authorization'] = `Bearer ${token}`;
});

📦 Features
🔐 Secure authentication with JWT

📝 Full CRUD for content types (posts, pages, etc.)

🧩 Headless architecture — decoupled frontend and backend

🎨 Responsive design with Vuetify

👥 Role-based access control (Admin, Editor, etc.)

🌐 API-first — ready for mobile, web, or external apps

🚀 Optimized for performance, SEO, and accessibility

📚 API Endpoints
All endpoints are prefixed with /api

Auth Routes
Method	Endpoint	Description
POST	/login	Authenticate user
POST	/logout	Revoke token
GET	/me	Get current user

Posts
Method	Endpoint	Description
GET	/posts	List all posts
GET	/posts/{id}	Get single post
POST	/posts	Create new post
PUT	/posts/{id}	Update post
DELETE	/posts/{id}	Delete post

You can create similar endpoints for other content types like Pages, Categories, and Media.

🔄 CORS Configuration
Ensure your backend’s config/cors.php contains:

php

'paths' => ['api/*', 'login', 'logout', 'me'],
'allowed_origins' => ['http://localhost:5173'], // Adjust for production
'allowed_headers' => ['*'],
'allowed_methods' => ['*'],

📸 Screenshots
(Optional – Add real screenshots of your CMS dashboard)

<p align="center"> <img src="screenshots/dashboard.png" width="80%" alt="CMS Dashboard Screenshot"> </p>
