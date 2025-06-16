# Laravel Product & Order Management System

[![Live Demo](https://img.shields.io/badge/demo-live-green.svg)](https://test-app-web-service.onrender.com)

A complete e-commerce management system built with Laravel for product and order management.

## Features

- Product CRUD operations
- Order management
- Category system
- Status tracking (New/Completed)
- Responsive interface

## Requirements

- PHP 8.0+
- Composer
- PostgreSQL/SQLite
- Node.js (for frontend dependencies)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Kolalexx/test-app.git
cd test-app
```

2. Install dependencies:

```bash
composer install
npm install
```

3. Configure environment:

```bash
cp .env.example .env
```
Edit .env file with your database credentials:

```ini
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=test_app
DB_USERNAME={your_name}
DB_PASSWORD=
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Run migrations and seeders:

```bash
php artisan migrate:fresh
php artisan db:seed --class=CategoriesTableSeeder
```

6. Build frontend assets:

```bash
npm run dev
```

## Running the Application

Start the development server:

```bash
php artisan serve
```

Access the application at: http://localhost:8000

## Testing

To run tests with SQLite in-memory database:

```bash
php artisan key:generate --env=testing
php artisan test --env=testing
```

## Live Demo

A working demo is available at: https://test-app-web-service.onrender.com
