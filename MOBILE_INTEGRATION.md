# Job Board - Mobile App Integration Guide

This guide provides instructions for building mobile applications that integrate with the Job Board API.

## API Base URL

```
http://your-domain.com/api
```

## Authentication

The API uses Sanctum tokens for authentication. All requests to protected endpoints must include the `Authorization` header:

```
Authorization: Bearer {token}
```

## Getting Started with React Native

### Installation

```bash
npx create-expo-app jobboard-mobile
cd jobboard-mobile
npm install axios react-native-secure-store @react-navigation/native @react-navigation/bottom-tabs
```

### Configuration

Create `src/config/api.ts`:

```typescript
import axios from "axios";
import AsyncStorage from "@react-native-async-storage/async-storage";

const API_BASE_URL = "http://your-domain.com/api";

export const api = axios.create({
    baseURL: API_BASE_URL,
    timeout: 10000,
});

api.interceptors.request.use(async (config) => {
    const token = await AsyncStorage.getItem("auth_token");
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            AsyncStorage.removeItem("auth_token");
            // Redirect to login
        }
        return Promise.reject(error);
    },
);

export default api;
```

### Services

Create `src/services/AuthService.ts`:

```typescript
import api from "../config/api";
import AsyncStorage from "@react-native-async-storage/async-storage";

export const authService = {
    register: async (name: string, email: string, password: string) => {
        const response = await api.post("/auth/register", {
            name,
            email,
            password,
            password_confirmation: password,
        });
        await AsyncStorage.setItem("auth_token", response.data.token);
        return response.data.user;
    },

    login: async (email: string, password: string) => {
        const response = await api.post("/auth/login", { email, password });
        await AsyncStorage.setItem("auth_token", response.data.token);
        return response.data.user;
    },

    logout: async () => {
        await api.post("/auth/logout");
        await AsyncStorage.removeItem("auth_token");
    },

    getProfile: async () => {
        const response = await api.get("/auth/me");
        return response.data;
    },
};
```

Create `src/services/ListingService.ts`:

```typescript
import api from "../config/api";

export const listingService = {
    getListings: async (page = 1, tag?: string) => {
        const params: any = { page };
        if (tag) params.tag = tag;
        const response = await api.get("/listings", { params });
        return response.data;
    },

    getListingDetails: async (id: number) => {
        const response = await api.get(`/listings/${id}/details`);
        return response.data;
    },

    search: async (query: string) => {
        const response = await api.get("/search", { params: { q: query } });
        return response.data;
    },

    createListing: async (data: any) => {
        const response = await api.post("/listings", data);
        return response.data;
    },

    updateListing: async (id: number, data: any) => {
        const response = await api.put(`/listings/${id}`, data);
        return response.data;
    },

    deleteListing: async (id: number) => {
        await api.delete(`/listings/${id}`);
    },

    applyToListing: async (id: number, message: string) => {
        const response = await api.post(`/listings/${id}/apply`, { message });
        return response.data;
    },

    rateListing: async (id: number, rating: number, comment?: string) => {
        const response = await api.post(`/listings/${id}/rate`, {
            rating,
            comment,
        });
        return response.data;
    },

    trackClick: async (id: number) => {
        await api.post(`/listings/${id}/click`);
    },
};
```

## Getting Started with Flutter

### Installation

```bash
flutter create jobboard_mobile
cd jobboard_mobile
flutter pub add http dio shared_preferences
```

### Configuration

Create `lib/config/api_client.dart`:

```dart
import 'package:dio/dio.dart';
import 'package:shared_preferences/shared_preferences.dart';

class ApiClient {
  static const String baseUrl = 'http://your-domain.com/api';
  late Dio dio;

  ApiClient() {
    dio = Dio(BaseOptions(
      baseUrl: baseUrl,
      connectTimeout: const Duration(seconds: 10),
      receiveTimeout: const Duration(seconds: 10),
    ));

    dio.interceptors.add(
      InterceptorsWrapper(
        onRequest: (options, handler) async {
          final prefs = await SharedPreferences.getInstance();
          final token = prefs.getString('auth_token');
          if (token != null) {
            options.headers['Authorization'] = 'Bearer $token';
          }
          return handler.next(options);
        },
        onError: (error, handler) async {
          if (error.response?.statusCode == 401) {
            final prefs = await SharedPreferences.getInstance();
            await prefs.remove('auth_token');
            // Redirect to login
          }
          return handler.next(error);
        },
      ),
    );
  }
}
```

## API Endpoints

### Authentication

- `POST /auth/register` - Register new user
- `POST /auth/login` - Login user
- `POST /auth/logout` - Logout user (requires auth)
- `GET /auth/me` - Get current user profile (requires auth)
- `PUT /auth/me` - Update user profile (requires auth)

### Listings

- `GET /listings` - Get all listings
    - Query params: `page`, `tag`
- `GET /listings/{id}` - Get single listing
- `GET /listings/{id}/details` - Get listing with full details
- `GET /search?q={query}` - Search listings
- `POST /listings` - Create listing (requires auth)
- `PUT /listings/{id}` - Update listing (requires auth)
- `DELETE /listings/{id}` - Delete listing (requires auth)

### Tags

- `GET /tags` - Get all available tags

### Applications

- `GET /applications` - Get user's applications (requires auth)
- `POST /listings/{id}/apply` - Apply to listing (requires auth)
- `GET /listings/{id}/applications` - Get listing applications (requires auth, must own listing)

### Ratings

- `POST /listings/{id}/rate` - Rate a listing (requires auth)
- `GET /ratings` - Get user's ratings (requires auth)

### Analytics

- `POST /listings/{id}/click` - Track a click (requires auth)

## Request/Response Format

All requests and responses use JSON format.

### Authentication Response

```json
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2026-02-15T00:00:00Z"
    },
    "token": "1|abc123xyz..."
}
```

### Listing Response

```json
{
    "id": 1,
    "title": "Senior Laravel Developer",
    "company": "Tech Corp",
    "location": "Remote",
    "description": "We're looking for...",
    "url": "https://example.com/apply",
    "is_active": true,
    "user_id": 1,
    "created_at": "2026-02-15T00:00:00Z",
    "tags": [
        { "id": 1, "name": "Laravel", "slug": "laravel" },
        { "id": 2, "name": "PHP", "slug": "php" }
    ]
}
```

## Error Handling

All errors return appropriate HTTP status codes with error messages:

```json
{
    "error": "The provided credentials are incorrect.",
    "message": "Error description"
}
```

Common status codes:

- `200` - OK
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `409` - Conflict
- `422` - Unprocessable Entity
- `500` - Server Error

## Testing

To test the API, you can use cURL:

```bash
# Get listings
curl http://localhost:8000/api/listings

# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Create listing (with token)
curl -X POST http://localhost:8000/api/listings \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{"title":"...","company":"...","location":"...","url":"...","description":"..."}'
```

## Environment Variables

Create `.env` file in mobile app root:

```
REACT_APP_API_URL=http://your-domain.com/api
```

Or for Flutter create `lib/config/environment.dart`:

```dart
class Environment {
  static const String apiUrl = 'http://your-domain.com/api';
}
```

## Support

For API issues, check the Laravel logs:

```bash
tail -f storage/logs/laravel.log
```
