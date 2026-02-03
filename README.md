# Laravel Boilerplate with Docker

A Laravel boilerplate project with Docker, MySQL, and Redis configured and ready to use.

## Features

- ✅ Laravel 10 framework
- ✅ Docker & Docker Compose setup
- ✅ MySQL 8.0 database
- ✅ Redis for caching, sessions, and queues
- ✅ Nginx web server
- ✅ PHP 8.2 with FPM
- ✅ Hello World endpoint on main page

## Requirements

- Docker
- Docker Compose

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd notificationsown
```

2. Copy the environment file:
```bash
cp .env.example .env
```

3. Build and start the Docker containers:
```bash
docker-compose up -d --build
```

4. Install PHP dependencies (inside the app container):
```bash
docker-compose exec app composer install
```

5. Generate application key:
```bash
docker-compose exec app php artisan key:generate
```

6. Run package discovery (if needed):
```bash
docker-compose exec app php artisan package:discover
```

7. Run database migrations (optional):
```bash
docker-compose exec app php artisan migrate
```

Usable tools:

Scripts with curl POST requests that will add notifications into database.
test-notify.ps1 (windows "curl")
test-notify.sh

adding notifications is checkecd by middleware if right token is provided in header under Bearer, comparing with hardcoded token from .env API_TOKEN

Usable pages with lists:
http://localhost/notifications
http://localhost/notifications/sent

Daemon worker, that contains basic logic that will flag notification as sent. Here could go logic with third party notifications.
docker-compose exec app php artisan notifications:process

Pushy requires in admin panel extra web application or android/ios application. Don't have such.

Twillio admin Panel throws me an error that parts of the application is not loading and infinite loop.

Documentation about Amazon emails documenation is too vast. Looks like configuartion of trusted emails is the work for DevOps.


## Usage

Once the containers are running, you can access the application at:

- **Main Application**: http://localhost
- **MySQL**: localhost:3306
  - Database: `laravel`
  - Username: `laravel`
  - Password: `root`
- **Redis**: localhost:6379

## Docker Commands

- Start containers: `docker-compose up -d`
- Stop containers: `docker-compose down`
- View logs: `docker-compose logs -f`
- Execute commands in app container: `docker-compose exec app <command>`
- Rebuild containers: `docker-compose up -d --build`

## Project Structure

```
.
├── app/                 # Application code
├── bootstrap/           # Bootstrap files
├── config/              # Configuration files
├── docker/              # Docker configuration
│   └── nginx/          # Nginx configuration
├── public/              # Public web root
├── routes/              # Route definitions
├── storage/             # Storage directory
├── tests/               # Tests
├── Dockerfile           # PHP-FPM container definition
└── docker-compose.yml   # Docker Compose configuration
```

## Configuration

The application is pre-configured to use:
- **Database**: MySQL (host: `mysql`)
- **Cache**: Redis (host: `redis`)
- **Sessions**: Redis (host: `redis`)
- **Queue**: Redis (host: `redis`)

All configuration can be modified in the `.env` file.

## License

MIT
