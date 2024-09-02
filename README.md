# modular-monolith-backend-template

## Documentation

This project is a modular monolith backend template built with Laravel 11, MySQL 8, and PHP 8.

## Technologies Used

- Laravel 11
- MySQL 8
- PHP 8

## Getting Started with Docker Containers

1. Make sure you have Docker installed on your machine.
2. Navigate to the project directory.
3. Run `docker-compose up -d` to start the Docker containers.
4. Access the application at `http://localhost:80`.

## Initiating Laravel

1. Run `composer install` to install the required dependencies.
2. Copy the `.env.example` file to `.env` and update the database credentials.
3. Run `php artisan key:generate` to generate a new application key.

## Migrations and Database Seeding

1. Run `php artisan migrate` to create the database tables.
2. Run `php artisan db:seed` to seed the database with initial data.

## Tests with PHPUnit

1. Run `vendor/bin/phpunit` to execute the test suite.
2. Create new test cases in the `tests` directory.

## API Routes

The API routes for this project are defined in the `routes/api.php` file. Here's an overview of the routes and their corresponding controllers:

### Authentication Routes

- `GET /users`: Retrieves a list of users (requires authentication).
- `POST /login`: Authenticates a user and generates an access token.

```json
{
  "email": "user@example.com",
  "password": "password"
}
```

- `POST /logout`: Logs out the authenticated user.
- `POST /register`: Registers a new user.

```json
{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "password",
  "is_admin": false,
  "partner_id": 1
}
```

- `POST /insert-user`: Inserts a new user (requires authentication).

```json
{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "password",
  "is_admin": false,
  "partner_id": 1
}
```

- `DELETE /delete-user/{user}`: Deletes a user (requires authentication).
- `GET /profile`: Retrieves the authenticated user's profile (requires authentication).
- `PUT /profile/{profile}`: Updates the authenticated user's profile (requires authentication).

```json
{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "newpassword"
}
```

These routes are handled by the `App\Http\Controllers\API\Auth\AuthController` controller.

### Resource Routes

- `GET /expenses`: Retrieves a list of expenses (requires authentication).
- `POST /expenses`: Creates a new expense (requires authentication).

```json
{
  "title": "Office Supplies",
  "description": "Purchase of pens, notebooks, and other stationery items",
  "date": "2023-05-15",
  "total_amount": 250.75,
  "user_id": 1
}
```

- `GET /expenses/{expense}`: Retrieves a specific expense (requires authentication).
- `PUT /expenses/{expense}`: Updates an existing expense (requires authentication).

```json
{
  "title": "Updated Office Supplies",
  "description": "Purchase of additional notebooks and highlighters",
  "date": "2023-05-16",
  "total_amount": 300.0,
  "user_id": 1
}
```

- `DELETE /expenses/{expense}`: Deletes an expense (requires authentication).

These routes are handled by the `App\Http\Controllers\API\Admin\ExpenseController` controller.

#### Partners

- `GET /partners`: Retrieves a list of partners (requires authentication).
- `POST /partners`: Creates a new partner (requires authentication).

```json
{
  "name": "Partner Company",
  "address": "123 Main St, City",
  "email": "partner@example.com"
}
```

- `GET /partners/{partner}`: Retrieves a specific partner (requires authentication).
- `PUT /partners/{partner}`: Updates an existing partner (requires authentication).

```json
{
  "name": "Updated Partner Company",
  "address": "456 Oak St, City",
  "email": "updatedpartner@example.com"
}
```

- `DELETE /partners/{partner}`: Deletes a partner (requires authentication).

These routes are handled by the `App\Http\Controllers\API\Admin\PartnerController` controller.

#### Contracts

- `GET /partners/{partner}/contracts`: Retrieves a list of contracts for a specific partner (requires authentication).
- `POST /partners/{partner}/contracts`: Creates a new contract for a specific partner (requires authentication).
- `GET /partners/{partner}/contracts/{contract}`: Retrieves a specific contract for a specific partner (requires authentication).
- `PUT /partners/{partner}/contracts/{contract}`: Updates an existing contract for a specific partner (requires authentication).
- `DELETE /partners/{partner}/contracts/{contract}`: Deletes a contract for a specific partner (requires authentication).

These routes are handled by the `App\Http\Controllers\API\Admin\ContractController` controller.
