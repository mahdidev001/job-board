<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Job Board - Multiplatform Application

A modern, multiplatform job board application built with Laravel. Deploy once, run everywhere - web, mobile (iOS/Android), and desktop.

## 🚀 Features

- **Web Application** - Full-featured Blade-based web UI
- **Mobile Apps** - Native iOS/Android apps via API
- **RESTful API** - Complete JSON API for all platforms
- **Token Authentication** - Sanctum-based secure auth
- **Job Listings** - Create, edit, search, and filter jobs
- **Job Applications** - Apply to jobs and track applications
- **Ratings & Reviews** - Rate employers and leave feedback
- **Real-time Analytics** - Track clicks and user engagement
- **Responsive Design** - Mobile-first Tailwind CSS
- **Full Documentation** - OpenAPI/Swagger specs included

## 📋 Quick Start

### Prerequisites

- PHP 8.2+
- MySQL/MariaDB
- Composer
- Node.js 18+

### Installation

```bash
# Clone and setup
composer install
npm install
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Development servers
php artisan serve              # Web app on http://localhost:8000
npm run dev                    # Asset compilation
```

### API Access

The API is immediately available at:

```
http://localhost:8000/api
```

Test it:

```bash
curl http://localhost:8000/api/health
curl http://localhost:8000/api/listings
```

## 📱 Building Mobile Apps

Choose your platform and framework:

### React Native (Expo)

```bash
npx create-expo-app jobboard-mobile
# See MOBILE_INTEGRATION.md for full setup
```

### Flutter

```bash
flutter create jobboard_mobile
# See MOBILE_INTEGRATION.md for full setup
```

### Web SPA (React/Vue)

```bash
npm create vite@latest jobboard-web -- --template react
# Use API endpoints for data fetching
```

## 🏗️ Architecture

```
┌──────────────────────────────────┐
│      Presentation Layer          │
│  Web │ Mobile │ Desktop │ SPA    │
└────────────────┬─────────────────┘
                 │
┌────────────────▼─────────────────┐
│    Laravel API (Sanctum Auth)    │
│  CORS │ Rate Limiting │ Logging  │
└────────────────┬─────────────────┘
                 │
┌────────────────▼─────────────────┐
│    Database Layer (MySQL)        │
│  Models │ Migrations │ Seeds     │
└──────────────────────────────────┘
```

## 📚 Documentation

- **[MULTIPLATFORM.md](./MULTIPLATFORM.md)** - Complete architecture and deployment guide
- **[MOBILE_INTEGRATION.md](./MOBILE_INTEGRATION.md)** - Mobile app integration examples
- **[openapi.json](./openapi.json)** - OpenAPI/Swagger specification
- **[API Endpoints](#-api-endpoints)** - Quick reference below

## 🔌 API Endpoints

### Authentication

```
POST   /api/auth/register         # Register new user
POST   /api/auth/login            # Login
POST   /api/auth/logout           # Logout (requires token)
GET    /api/auth/me               # Get profile (requires token)
PUT    /api/auth/me               # Update profile (requires token)
```

### Listings

```
GET    /api/listings              # List all jobs
GET    /api/listings/{id}         # Get job details
GET    /api/search?q=keyword      # Search jobs
POST   /api/listings              # Create job (requires token)
PUT    /api/listings/{id}         # Update job (requires token)
DELETE /api/listings/{id}         # Delete job (requires token)
```

### Applications

```
POST   /api/listings/{id}/apply   # Apply to job (requires token)
GET    /api/applications          # Get my applications (requires token)
```

### Ratings

```
POST   /api/listings/{id}/rate    # Rate a listing (requires token)
GET    /api/ratings               # Get my ratings (requires token)
```

### Other

```
GET    /api/health                # Health check
GET    /api/tags                  # Get all tags
POST   /api/listings/{id}/click   # Track click (requires token)
```

## 🔐 Authentication

The API uses Laravel Sanctum for token-based authentication:

```javascript
// Login
const response = await fetch("http://localhost:8000/api/auth/login", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ email: "user@example.com", password: "password" }),
});

const { token, user } = await response.json();

// Use token for authenticated requests
const listings = await fetch("http://localhost:8000/api/listings", {
    headers: { Authorization: `Bearer ${token}` },
});
```

## 🔧 Configuration

Key environment variables in `.env`:

```env
APP_NAME=JobHub
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=job_board
DB_USERNAME=root

# CORS for mobile/SPA clients
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:8100
```

## 📦 Deployment

### Production Server

```bash
# Build assets
npm run build

# Set environment
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database
php artisan migrate --force
```

### Docker

```bash
docker build -t jobboard .
docker run -p 8000:8000 jobboard
```

### Vercel/Netlify (Frontend)

Deploy your React/Vue SPA separately pointing to your API.

## 🧪 Testing

```bash
# Run feature tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test
php artisan test tests/Feature/ListingTest.php
```

## 🤝 Contributing

Pull requests are welcome! Please ensure tests pass:

```bash
composer test
```

## 📝 License

This project is open source and available under the MIT License.

## 📞 Support

For issues and questions:

1. Check [MULTIPLATFORM.md](./MULTIPLATFORM.md) troubleshooting section
2. Review API docs in [openapi.json](./openapi.json)
3. Check Laravel logs: `tail -f storage/logs/laravel.log`

---

**Built with Laravel & Tailwind CSS** ❤️

Built to be **Multiplatform** 🚀

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
