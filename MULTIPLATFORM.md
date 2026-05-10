# Job Board - Multiplatform Architecture

This Job Board application is now fully multiplatform-ready, supporting web, mobile (iOS/Android), and desktop clients through a unified RESTful API.

## Architecture Overview

The application uses a **Backend-for-Frontend (BFF)** architecture:

```
┌─────────────────────────────────────────────────────┐
│         Web Browser (Blade Templates)               │
│     Laravel Web Routes (/routes/web.php)            │
└──────────────────┬──────────────────────────────────┘
                   │
┌──────────────────┴──────────────────────────────────┐
│      Laravel Backend with Sanctum Auth              │
│  (Database, Business Logic, Validation)             │
└──────────────────┬──────────────────────────────────┘
                   │
     ┌─────────────┼─────────────┬──────────────┐
     │             │             │              │
┌────▼──────┐ ┌───▼────────┐ ┌─▼────────────┐ ┌▼──────────┐
│React Native│ │  Flutter   │ │Desktop (Qt)  │ │Web SPA    │
│(iOS/Droid) │ │(iOS/Droid) │ │(Electron)    │ │(Vue/React)│
└───────────┘ └────────────┘ └──────────────┘ └──────────┘

      API Routes (/routes/api.php)
      Sanctum Token Authentication
      JSON Responses
```

## Directory Structure

```
job-board-test/
├── routes/
│   ├── web.php              # Web UI routes (existing)
│   └── api.php              # API routes (NEW)
├── app/Http/
│   ├── Controllers/
│   │   └── [Web Controllers]
│   └── Controllers/Api/     # NEW API Controllers
│       ├── ListingApiController.php
│       ├── AuthApiController.php
│       ├── TagApiController.php
│       ├── RatingApiController.php
│       ├── ClickApiController.php
│       └── ApplicationApiController.php
├── config/
│   ├── cors.php             # NEW CORS Configuration
│   └── [other configs]
├── bootstrap/
│   └── app.php              # UPDATED with API middleware
├── openapi.json             # NEW OpenAPI/Swagger spec
├── MOBILE_INTEGRATION.md    # NEW Integration guide
└── [existing files]
```

## Getting Started

### 1. Setup the Backend

```bash
# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate
php artisan db:seed

# Start development server
php artisan serve
```

The API will be available at: `http://localhost:8000/api`

### 2. Test the API

Using curl:

```bash
# Check health
curl http://localhost:8000/api/health

# Get listings
curl http://localhost:8000/api/listings

# Register user
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name":"John Doe",
    "email":"john@example.com",
    "password":"password123",
    "password_confirmation":"password123"
  }'
```

### 3. Build a Mobile App

See [MOBILE_INTEGRATION.md](./MOBILE_INTEGRATION.md) for detailed guides on:

- **React Native** (iOS & Android)
- **Flutter** (iOS & Android)

### 4. Build a Desktop App

Using Electron, Tauri, or Qt:

```javascript
// Electron example
const axios = require("axios");

const api = axios.create({
    baseURL: "http://localhost:8000/api",
});

// Login
api.post("/auth/login", {
    email: "user@example.com",
    password: "password",
}).then((res) => {
    localStorage.setItem("token", res.data.token);
    api.defaults.headers.common["Authorization"] = `Bearer ${res.data.token}`;
});
```

## Key Features

### ✅ Authentication (Sanctum Tokens)

- User registration and login
- Token-based authentication for APIs
- Session support for web
- Cross-platform token management

### ✅ Job Listings

- Create, read, update, delete (CRUD) operations
- Tag-based filtering
- Full-text search
- Pagination support

### ✅ Job Applications

- Apply to jobs with messages
- Track application history
- View applications received (for job posters)

### ✅ Ratings & Reviews

- Rate employers/jobs
- Leave comments
- View rating history

### ✅ Analytics

- Track listing clicks
- Monitor user interactions

### ✅ Responsive Design

- Mobile-first Tailwind CSS
- Safe area support for notches/bezels
- Touch-friendly interfaces

## API Endpoints

### Public Endpoints (No Authentication Required)

```
GET    /api/health                    # Health check
GET    /api/listings                  # List all jobs
GET    /api/listings/{id}             # Get job details
GET    /api/listings/{id}/details     # Get full job details
GET    /api/search?q=keyword          # Search jobs
GET    /api/tags                      # Get available tags
POST   /api/auth/register             # Register new user
POST   /api/auth/login                # Login user
```

### Protected Endpoints (Requires Token)

```
POST   /api/auth/logout               # Logout
GET    /api/auth/me                   # Get profile
PUT    /api/auth/me                   # Update profile
POST   /api/listings                  # Create listing
PUT    /api/listings/{id}             # Update listing
DELETE /api/listings/{id}             # Delete listing
POST   /api/listings/{id}/apply       # Apply to job
GET    /api/applications              # View my applications
POST   /api/listings/{id}/rate        # Rate listing
GET    /api/ratings                   # View my ratings
POST   /api/listings/{id}/click       # Track click
```

## Environment Configuration

Update `.env` for CORS and API settings:

```env
# API Configuration
API_URL=http://localhost:8000
API_PREFIX=/api

# CORS Settings
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:5173,http://localhost:8100,http://localhost:19006
CORS_ALLOWED_ORIGINS_PATTERNS=

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_board
DB_USERNAME=root
DB_PASSWORD=

# Session
SESSION_DRIVER=database
CACHE_DRIVER=database

# Other
APP_NAME=JobHub
APP_ENV=local
APP_DEBUG=true
```

## Authentication Flow

### Web Application

```
1. User fills login form
2. POST /api/auth/login with credentials
3. Receive token
4. Store in localStorage or cookies
5. Include in Authorization header for subsequent requests
6. Session maintained in DB/Cache
```

### Mobile Application

```
1. User enters credentials in app
2. POST /api/auth/login with credentials
3. Receive token + user data
4. Store token securely (Keychain/Keystore)
5. Include in Authorization header
6. Token-based auth persists until logout/expiry
7. Automatic token refresh on expiry
```

## CORS Configuration

The API is configured to accept requests from:

- `http://localhost:3000` (React dev server)
- `http://localhost:5173` (Vite dev server)
- `http://localhost:8100` (Ionic dev server)
- `http://localhost:19006` (Expo dev server)

Add your deployment domains to `CORS_ALLOWED_ORIGINS` in `.env`.

## Database Models

The application uses these models for the multiplatform setup:

- **User** - User accounts with authentication
- **Listing** - Job listings created by users
- **Tag** - Job categories/tags
- **ListingTag** - Many-to-many relationship
- **Application** - Job applications from users
- **Rating** - Employer/job ratings
- **Click** - Analytics tracking

See migrations in `database/migrations/` for full schema.

## Testing the API

### Using Postman

1. Import `openapi.json` into Postman
2. Set `{{base_url}}` variable to `http://localhost:8000/api`
3. Use the generated collection to test endpoints

### Using curl

See examples in [MOBILE_INTEGRATION.md](./MOBILE_INTEGRATION.md)

### Using API client libraries

- **JavaScript/Node.js**: axios, fetch API
- **Python**: requests, httpx
- **Dart/Flutter**: http, dio
- **Swift**: URLSession, Alamofire
- **Kotlin**: Retrofit, OkHttp

## Performance Optimization

### Backend

- Database indexing on frequently queried fields
- Pagination (20 items per page by default)
- Eager loading of relationships (tags, user)
- Query optimization with `select()` and `with()`

### Frontend

- Token caching (localStorage/Keychain)
- Request debouncing for search
- Image lazy loading
- Code splitting for faster loads

### API Rate Limiting

Add to `app/Http/Middleware/` or use Laravel's built-in throttling:

```php
Route::middleware('throttle:60,1')->group(function () {
    Route::apiResource('posts', PostController::class);
});
```

## Deployment

### Production Setup

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Configure CORS allowed origins for your domain
3. Use HTTPS for all API calls
4. Enable token expiration and refresh tokens
5. Implement rate limiting
6. Set up proper error logging
7. Configure database backups

### Docker Deployment

```dockerfile
FROM php:8.2-fpm
RUN docker-php-ext-install pdo pdo_mysql
COPY . /app
WORKDIR /app
RUN composer install
```

## Troubleshooting

### CORS Errors

- Ensure request origin is in `CORS_ALLOWED_ORIGINS`
- Check browser console for detailed error messages
- Verify `Accept: application/json` header

### Authentication Issues

- Verify token is included in `Authorization: Bearer {token}` header
- Check token hasn't expired
- Ensure user exists in database

### API Not Responding

- Check Laravel logs: `tail -f storage/logs/laravel.log`
- Verify database connection
- Ensure API route is registered in `routes/api.php`

## Support & Documentation

- **API Documentation**: See `openapi.json`
- **Mobile Integration**: See `MOBILE_INTEGRATION.md`
- **Laravel Documentation**: https://laravel.com/docs
- **Sanctum Documentation**: https://laravel.com/docs/sanctum

## License

This project is open source and available under the MIT License.

---

**Happy coding! 🚀**

Build amazing multiplatform experiences with this Job Board API!
