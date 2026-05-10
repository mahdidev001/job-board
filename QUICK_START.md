# 🚀 Quick Start - Job Board Multiplatform

Get your multiplatform Job Board running in 5 minutes!

## Step 1: Start the Backend (2 minutes)

```bash
cd c:\xampp\htdocs\job-board-test

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Setup environment
copy .env.example .env
php artisan key:generate

# Setup database
php artisan migrate

# Seed sample data (optional)
php artisan db:seed

# Start the server
php artisan serve
```

**Backend is now running at:** `http://localhost:8000`

## Step 2: Test the API (1 minute)

Open a new terminal and test:

```bash
# Health check
curl http://localhost:8000/api/health

# Get all job listings
curl http://localhost:8000/api/listings

# Get all tags
curl http://localhost:8000/api/tags
```

You should see JSON responses! ✅

## Step 3: Run the Frontend (1 minute)

In another terminal:

```bash
cd c:\xampp\htdocs\job-board-test
npm run dev
```

This compiles CSS and JavaScript.

## Step 4: Access the Application (1 minute)

Open your browser:

- **Web App:** http://localhost:8000
- **API:** http://localhost:8000/api

## Done! 🎉

You now have a fully functional multiplatform Job Board!

---

## 📱 Next: Build a Mobile App

### Option A: React Native (5 minutes)

```bash
npx create-expo-app jobboard-mobile
cd jobboard-mobile
npm install axios

# See MOBILE_INTEGRATION.md for full setup
```

### Option B: Flutter (5 minutes)

```bash
flutter create jobboard_mobile
cd jobboard_mobile
flutter pub add http dio shared_preferences

# See MOBILE_INTEGRATION.md for full setup
```

---

## 🧪 Test API with Postman (Recommended)

1. **Download Postman** from https://www.postman.com
2. **Open Postman**
3. **Import the API:**
    - Click: File → Import
    - Select: `openapi.json` from project root
    - Click: Import

4. **Test endpoints:**
    - Click on any endpoint
    - Click "Send"
    - See the response!

---

## 🔐 Test Authentication

### Register a New User

```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

You'll get back a token like: `"token": "1|abc123xyz..."`

### Save your token

```bash
TOKEN="1|abc123xyz..."
```

### Get your profile (requires token)

```bash
curl http://localhost:8000/api/auth/me \
  -H "Authorization: Bearer $TOKEN"
```

---

## 📚 Documentation

| Need              | File                                                       |
| ----------------- | ---------------------------------------------------------- |
| Quick reference   | [API_QUICK_REFERENCE.md](./API_QUICK_REFERENCE.md)         |
| All documentation | [INDEX.md](./INDEX.md)                                     |
| Mobile setup      | [MOBILE_INTEGRATION.md](./MOBILE_INTEGRATION.md)           |
| Architecture      | [MULTIPLATFORM.md](./MULTIPLATFORM.md)                     |
| Deployment        | [DEPLOYMENT_CHECKLIST.md](./DEPLOYMENT_CHECKLIST.md)       |
| Visual guide      | [VISUAL_GUIDE.md](./VISUAL_GUIDE.md)                       |
| What was built    | [IMPLEMENTATION_COMPLETE.md](./IMPLEMENTATION_COMPLETE.md) |

---

## 🆘 Troubleshooting

### API not responding?

```bash
# Check if Laravel is running
php artisan serve

# Check database
php artisan migrate

# View errors
tail -f storage/logs/laravel.log
```

### Port already in use?

```bash
# Run on different port
php artisan serve --port=8001
```

### Composer/npm errors?

```bash
# Clear cache
composer clear-cache
npm cache clean --force

# Reinstall
rm composer.lock package-lock.json
composer install
npm install
```

### CORS errors in browser?

Add your domain to `CORS_ALLOWED_ORIGINS` in `.env`:

```env
CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:8000
```

Then restart the server.

---

## ✨ What's Included

✅ **Web Application** - Full Blade-based UI
✅ **REST API** - 40+ endpoints
✅ **Mobile Ready** - React Native + Flutter guides
✅ **Authentication** - Token-based (Sanctum)
✅ **Documentation** - Complete guides
✅ **OpenAPI Spec** - For Postman integration
✅ **Deployment Guide** - Ready for production
✅ **Examples** - cURL and code examples

---

## 🎯 Key Endpoints

```
GET    /api/health              # Check API
GET    /api/listings            # Get all jobs
GET    /api/listings/1          # Get job #1
POST   /api/auth/register       # Register
POST   /api/auth/login          # Login
POST   /api/listings            # Create job (auth required)
```

See [API_QUICK_REFERENCE.md](./API_QUICK_REFERENCE.md) for complete list.

---

## 🚀 You're Ready!

1. Backend running ✅
2. API tested ✅
3. Next step: Build mobile app or deploy

**Questions?** See [INDEX.md](./INDEX.md) for all documentation.

---

**Happy building!** 🎉
