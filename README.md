<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache)
  storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Project Overview

This project integrates Docker, Laravel, Vue.js, and PostgreSQL to provide a robust and scalable web application. The
following sections outline the architecture decisions, deployment steps, environment setup, and specific configuration
requirements for this project.

### Architecture Decisions

Docker: Used for containerization to ensure consistent development and production environments.
Laravel: PHP framework for building the backend API.
Vue.js: JavaScript framework for building the frontend application.
PostgreSQL: Relational database management system for storing application data.

## Deployment Steps

### Prerequisites

- Docker installed on the system
- Docker Compose installed on the system

### Deployment

1. Clone the repository: **git clone https://github.com/wesley-a-santos/Curotec-Laravel-Vue-Challenge.git**

2. Navigate to the project directory: **cd Curotec-Laravel-Vue-Challenge**

3. Install dependencies:
    1. **composer install**
    2. **npm install** or **yarn install**
    3.

4. Build assets:
    1. **npm run build**

5. Build the Docker images using [Laravel Sail](https://laravel.com/docs/10.x/sail): **./vendor/bin/sail up -d**

6. Initialize and seed the database: **./vendor/bin/sail artisan migrate --seed**

7. Access the application: **http://localhost**

7. Test user:
   - Email: **test@example.com**
   - Password: **password**

#### Optional Steps

1. Seed users for testing (optional): **sail artisan db:seed --class=UserSeeder**

2. Seed clients for the test user (optional): **sail artisan db:seed --class=ClientSeeder**

## Environment Setup

### Docker Compose Configuration

The **docker-compose.yml** file defines the services and their configurations. The following services are defined:

- **laravel.test**: Laravel application container
- **pgsql**: PostgreSQL database container
- **redis**: Redis cache container
- **mailpit**: Mailpit container for email testing

### Environment Variables

The following environment variables are defined in the **.env.example** file:

- **APP_NAME**: Application name
- **APP_URL**: Application URL
- **APP_ENV**: Application environment (local, stating, production)
- **DB_HOST**: PostgreSQL database host
- **DB_PORT**: PostgreSQL database port
- **DB_DATABASE**: PostgreSQL database name
- **DB_USERNAME**: PostgreSQL database username
- **DB_PASSWORD**: PostgreSQL database password
- **REDIS_HOST**: Redis cache host
- **REDIS_PASSWORD**: Redis cache password
- **CACHE_DRIVER**: Cache driver (redis)
- **QUEUE_CONNECTION**: Queue connection (redis)
- **SESSION_DRIVER**: Session driver (redis)
- **MAIL_MAILER**: Mail driver
- **MAIL_HOST**: Mail host
- **MAIL_PORT**: Mail port

Copy the **.env.example** file to **.env** and adjust the values as needed.

## Laravel Configuration

The Laravel application is configured in the **config** directory. The following configurations are defined:

- **app.php**: Application configuration
- **database.php**: Database configuration
- **cache.php**: Cache configuration
- **mail.php**: Mail configuration

Update the configuration files to match your requirements.

## Troubleshooting

Check the Docker logs for errors: docker-compose logs
Check the Laravel logs for errors: docker-compose exec php php artisan logs
Check the Vue.js logs for errors: docker-compose exec vue npm run logs

## Conclusion

This project integrates Docker, Laravel, Vue.js, and PostgreSQL to provide a robust and scalable web application. By
following the deployment steps, environment setup, and specific configuration requirements outlined in this README, you
should be able to successfully deploy and run the application.






