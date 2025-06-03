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
🧪 Testing
Coming soon – Add your unit or API test instructions here:

bash
Copy
Edit
php artisan test
🤝 Contributing
Contributions are welcome! Please fork this repo and submit a pull request.
Follow PSR standards and Vue best practices when contributing.

🛡 License
This project is open-sourced software licensed under the MIT License.

vbnet
Copy
Edit

Let me know if you'd like to add database ER diagrams, Swagger/OpenAPI docs, or Docker setup instructio
