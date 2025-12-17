# Laravel E-Commerce Platform

<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
</p>

A modern e-commerce platform built with Laravel 12, featuring a responsive frontend and comprehensive admin dashboard.

## Features

### Customer Features
- **Product Catalog**: Browse products by categories and brands
- **User Authentication**: Register, login, and manage account
- **Shopping Cart**: Add/remove products, proceed to checkout
- **Wishlist**: Save products for later
- **Order Management**: View order history and status
- **Address Management**: Add and manage multiple shipping addresses

### Admin Features
- **Dashboard**: Overview of sales and activities
- **Product Management**: Add, edit, and delete products
- **Category & Brand Management**: Organize products effectively
- **Order Processing**: Update order status and track fulfillment
- **User Management**: Manage customer accounts

## Technologies Used

- **PHP 8.2+**
- **Laravel 12.x**
- **Tailwind CSS 4.0**
- **Alpine.js**
- **MySQL/PostgreSQL**
- **Spatie Media Library** for image management
- **Laravel Debugbar** for development

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL or PostgreSQL database

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/ethericsolution/laravel-ecommerce.git
   cd laravel-ecommerce
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Create and configure your environment file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

6. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

7. Create a symbolic link for storage:
   ```bash
   php artisan storage:link
   ```

8. Build assets:
   ```bash
   npm run build
   ```

## Development

Run the development server:
```bash
composer dev
```

This will start the Laravel server, queue worker, and Vite development server concurrently.

## Project Structure

- **app/** - Contains the core code of the application
  - **Http/Controllers/** - Controllers for handling requests
  - **Models/** - Eloquent models representing database tables
  - **Enums/** - PHP enums for status types and other constants
- **routes/** - Application routes
  - **web.php** - Main application routes
  - **admin.php** - Admin panel routes
  - **auth.php** - Authentication routes
- **resources/** - Frontend assets and views
- **database/** - Migrations, factories, and seeders
- **config/** - Configuration files
- **public/** - Publicly accessible files

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgments

- [Laravel](https://laravel.com) - The web framework used
- [Tailwind CSS](https://tailwindcss.com) - For styling
- [Alpine.js](https://alpinejs.dev) - For frontend interactivity
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary) - For image management
- - [FlyonUI](https://flyonui.com) - UI used for the frontend

