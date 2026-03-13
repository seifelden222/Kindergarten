# Kindergarten Management System

A Laravel 12 web application for managing a kindergarten portal with role-based dashboards for admins, teachers, guardians, and children.

## Overview

This project includes:

- Authentication with Laravel Breeze
- Role-based access control through custom middleware
- Separate dashboards and pages for each user role
- Core kindergarten data models for activities, attendance, and behavioral notes

## User Roles

The application currently routes users to different areas based on their `role` value:

- `admin`: administration dashboard and management pages
- `teacher`: teacher dashboard, levels, messages, and reports
- `guardian`: parent dashboard, payments, attendance follow-up, messages, and notifications
- `child`: child home, attendance, activities, surprise page, and teacher notes

The redirect logic is handled in the `dashboard` route and the [`User` model](/home/seifelden-hamdy/Coding/Web/BackProject-PHP/laravel12/SELF_Projects/Kindergarten/app/Models/User.php).

## Main Features

- Public landing page and contact page
- Authenticated profile management
- Role-protected route groups for admin, teacher, guardian, and child areas
- Eloquent models for:
  - [`Activity`](/home/seifelden-hamdy/Coding/Web/BackProject-PHP/laravel12/SELF_Projects/Kindergarten/app/Models/Activity.php)
  - [`Attendance`](/home/seifelden-hamdy/Coding/Web/BackProject-PHP/laravel12/SELF_Projects/Kindergarten/app/Models/Attendance.php)
  - [`BehavioralNote`](/home/seifelden-hamdy/Coding/Web/BackProject-PHP/laravel12/SELF_Projects/Kindergarten/app/Models/BehavioralNote.php)

## Tech Stack

- PHP 8.4
- Laravel 12
- Laravel Breeze
- Blade templates
- Vite
- Tailwind CSS
- Pest

## Project Structure

Important paths:

- [`routes/web.php`](/home/seifelden-hamdy/Coding/Web/BackProject-PHP/laravel12/SELF_Projects/Kindergarten/routes/web.php): web routes and role-based sections
- [`app/Http/Middleware/EnsureRole.php`](/home/seifelden-hamdy/Coding/Web/BackProject-PHP/laravel12/SELF_Projects/Kindergarten/app/Http/Middleware/EnsureRole.php): role authorization middleware
- `resources/views/admin`: admin pages
- `resources/views/teacher`: teacher pages
- `resources/views/parent`: guardian pages
- `resources/views/child`: child pages

## Installation

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Create the environment file:

```bash
cp .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Configure your database in `.env`.
7. Run migrations:

```bash
php artisan migrate
```

## Running the Project

For local development:

```bash
composer run dev
```

This starts:

- Laravel local server
- queue listener
- pail logs
- Vite dev server

If you prefer running services separately:

```bash
php artisan serve
npm run dev
```

For a production frontend build:

```bash
npm run build
```

## Testing

Run the test suite with:

```bash
php artisan test --compact
```

## Notes

- The project currently uses the default Laravel package name and description in [`composer.json`](/home/seifelden-hamdy/Coding/Web/BackProject-PHP/laravel12/SELF_Projects/Kindergarten/composer.json). If this repository is going to be shared publicly, updating that metadata would be a good next cleanup step.
- Some page names and routes still reflect the current implementation exactly, including spellings like `absense` and `activties`.

## License

This project is open-sourced under the MIT license.
