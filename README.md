# Power BI Embed App

Welcome to the Power BI Embed App documentation. This project is a robust, modular monolith backend template built with Laravel 11, MySQL 8, and PHP 8. It provides a comprehensive solution for embedding Power BI reports with advanced user access control and management features.

## Key Features

- Built on Laravel 11 framework
- MySQL 8 database integration
- PHP 8 compatibility
- Docker containerization support
- User authentication and authorization
- Role-based access control
- Group-based permissions
- Report and workspace management
- RESTful API architecture

This documentation will guide you through the setup process, explain the core functionalities, and provide detailed information on the API endpoints available in this application. Whether you're a developer looking to extend the functionality or an administrator setting up the system, you'll find all the necessary information to get started and make the most of the Power BI Embed App.

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

## User Access Policy by Groups

This feature allows for fine-grained control over user access to reports based on roles and group memberships.

### Roles

- `GET /roles`: Retrieves a list of roles (requires admin authentication).
- `POST /roles`: Creates a new role (requires admin authentication).

```json
{
  "name": "Editor",
  "description": "Can edit and view reports"
}
```

- `GET /roles/{role}:` Retrieves a specific role (requires admin authentication).
- `PUT /roles/{role}:` Updates an existing role (requires admin authentication).
- `DELETE /roles/{role}:` Deletes a role (requires admin authentication).

### Groups

- `GET /groups`: Retrieves a list of groups (requires admin authentication).
- `POST /groups`: Creates a new group (requires admin authentication).

```json
{
  "name": "Marketing Team",
  "description": "Group for marketing team members"
}
```

- `GET /groups/{group}:` Retrieves a specific group (requires admin authentication).
- `PUT /groups/{group}:` Updates an existing group (requires admin authentication).
- `DELETE /groups/{group}:` Deletes a group (requires admin authentication).

### User Group Management

- `GET /users/{user}/groups`: Retrieves a list of groups for a specific user (requires authentication).
- `POST /users/{user}/groups/{group}`: Adds a user to a group (requires admin authentication).

```json
{
  "user_id": 1
}
```

- `DELETE /users/{user}/groups/{group}`: Removes a user from a group (requires admin authentication).

### Role Management

- `GET /users/{user}/roles`: Retrieves a list of roles for a specific user (requires authentication).
- `POST /users/{user}/roles/{role}`: Assigns a role to a user (requires admin authentication).

```json
{
  "role_id": 1
}
```

- `DELETE /users/{user}/roles/{role}`: Removes a role from a user (requires admin authentication).

### Report

- `GET /reports`: Retrieves a list of reports (requires authentication).
- `POST /reports`: Creates a new report (requires authentication).

```json
{
  "title": "Monthly Sales Report",
  "description": "Sales report for the month of May",
  "workspace_id": 1,
  "embed_url": "https://app.powerbi.com/reportEmbed?reportId=f6bfd646-b718-44dc-a378-b73e6b528204&groupId=be8908da-da25-452e-b220-163f52476cdd&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly9XQUJJLVVTLU5PUlRILUNFTlRSQUwtcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQifQ%3d%3d"
}
```

- `GET /reports/{report}`: Retrieves a specific report (requires authentication).
- `PUT /reports/{report}`: Updates an existing report (requires authentication).
- `DELETE /reports/{report}`: Deletes a report (requires authentication).

# Workspace

- `GET /workspaces`: Retrieves a list of workspaces (requires authentication).
- `POST /workspaces`: Creates a new workspace (requires authentication).

```json
{
  "name": "Comercial Department",
  "description": "Description of the workspace"
}
```

- `GET /workspaces/{workspace}`: Retrieves a specific workspace (requires authentication).
- `PUT /workspaces/{workspace}`: Updates an existing workspace (requires authentication).
- `DELETE /workspaces/{workspace}`: Deletes a workspace (requires authentication).
