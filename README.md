# Contact Management

Laravel 10 CRUD application for contact management, built for a technical challenge.

## Features

- Public contact list page.
- Authenticated create, view details, edit, and delete actions.
- Soft delete for contacts.
- Validation rules:
  - `name`: required, min 6 chars
  - `contact`: required, 9 digits, unique among active contacts
  - `email`: required, valid format, unique among active contacts
- Basic authentication flow (login/logout).
- Seeded admin user for challenge evaluation.
- Feature tests for validation scenarios.

## Stack

- PHP 8.1+
- Laravel 10
- MySQL/MariaDB (challenge environment)
- SQLite (testing)

## Local setup

1. Install dependencies:
   - `composer install`
2. Create env file:
   - `cp .env.example .env`
3. Generate app key:
   - `php artisan key:generate`
4. Configure database in `.env`.
5. Run migrations and seeders:
   - `php artisan migrate --seed`
6. Start app:
   - `php artisan serve`

## Challenge credentials

If authentication is enabled, use:

- Email: `admin@admin.com`
- Password: `123456`

## Run tests

- `php artisan test`
