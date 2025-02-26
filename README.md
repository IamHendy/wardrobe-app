# Wardrobe Management System

A web-based application that allows users to manage their clothing inventory through a modern, responsive interface. Each user has their own wardrobe where they can add, edit, delete, and categorize their clothing items. Users can also mark items as favorites and search or filter their collections. This project is built with **Laravel 11** on the backend and **Vue 3** with **Inertia.js** on the frontend, ensuring smooth integration and user-specific data handling.

## Features

- **User Authentication:**  
  Secure registration, login, and logout using session-based authentication.  
- **Clothing Management:**  
  - **Add Clothes:** Upload images, assign a category, and mark items as favorites.  
  - **Edit & Delete:** Modify or remove clothing items.  
  - **Categorization:** Organize your wardrobe by categories (e.g., Tops, Pants, Dresses, Shoes, Outerwear, Accessories).  
- **Favorites:**  
  Easily mark and view your favorite clothing items.
- **Search & Filtering:**  
  Quickly search for or filter clothing items by name or category.
- **Responsive Design:**  
  Built with Tailwind CSS for a modern and mobile-friendly user interface.
- **User-Specific Data:**  
  Each logged-in user can only access and manage their own wardrobe.

## Prerequisites

Ensure you have the following installed before running the project:

- **PHP 8.0+** (required for Laravel 11)
- **Composer** (for managing PHP dependencies)
- **Node.js and npm** (or Yarn) for frontend dependencies
- **Database:** MySQL, PostgreSQL, or SQLite
- **Local Server Environment:** XAMPP, Laragon, or similar for development

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/IamHendy/wardrobe-app
   cd wardrobe-management-system

2. **Install Backend Dependencies**
  composer install

3. **npm install**
   npm install

4. **Environment Setup**
cp .env.example .env

5. **Generate Application Key**
php artisan key:generate

6. **Run Migrations**
php artisan migrate

7. **Create Storage Symlink**

php artisan storage:link


**Running the Application**
There are two servers to run: the Laravel backend and the Vite-powered frontend.

**Start the Backend Server**

bash
Copy
Edit
php artisan serve
The backend will typically be accessible at http://127.0.0.1:8000.

Start the Frontend Vite Server

**In a separate terminal, run:**

bash
Copy
Edit
npm run dev
This will start the Vite server and compile your Vue 3 components. The frontend is usually accessible at http://127.0.0.1:3000 or as configured in your project.

**Additional Notes**
Session-Based Authentication:
This project uses Laravel’s built-in session-based authentication. Ensure your browser accepts cookies so that authentication persists.
Image Storage:
Uploaded images and default avatars are stored in storage/app/public. The php artisan storage:link command makes them accessible via public/storage.
Environment Configuration:
For production, update your .env file with proper database credentials, caching configurations, and set up a production-ready web server (e.g., Nginx or Apache).
Debugging:
If you encounter errors (e.g., 500 Internal Server Error), check the Laravel logs at storage/logs/laravel.log for detailed information.



