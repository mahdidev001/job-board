# API Quick Reference

## Base URL

```
http://localhost:8000/api
```

## Authentication

All protected endpoints require:

```
Authorization: Bearer {token}
Content-Type: application/json
```

---

## 🔓 Public Endpoints

### Health Check

```
GET /health
→ { "status": "ok" }
```

### Authentication

**Register**

```
POST /auth/register
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
→ { "user": {...}, "token": "1|abc..." }
```

**Login**

```
POST /auth/login
{
  "email": "john@example.com",
  "password": "password123"
}
→ { "user": {...}, "token": "1|abc..." }
```

### Listings

**List all jobs**

```
GET /listings?page=1&tag=laravel
→ {
  "data": [...],
  "current_page": 1,
  "last_page": 5,
  "total": 100
}
```

**Get job details**

```
GET /listings/1
→ {
  "id": 1,
  "title": "Senior Developer",
  "company": "Tech Corp",
  "location": "Remote",
  "description": "...",
  "url": "https://...",
  "tags": [...]
}
```

**Get detailed job info**

```
GET /listings/1/details
→ {
  "id": 1,
  "title": "Senior Developer",
  ...,
  "user": { "id": 1, "name": "Company", "email": "..." }
}
```

### Search

**Search jobs**

```
GET /search?q=developer
→ { "data": [...] }
```

### Tags

**Get all tags**

```
GET /tags
→ [
  { "id": 1, "name": "Laravel", "slug": "laravel" },
  { "id": 2, "name": "PHP", "slug": "php" },
  ...
]
```

---

## 🔐 Protected Endpoints (Require Token)

### Authentication

**Get current user**

```
GET /auth/me
→ { "id": 1, "name": "John", "email": "..." }
```

**Update profile**

```
PUT /auth/me
{
  "name": "John Doe",
  "email": "newemail@example.com",
  "password": "newpass123",        # optional
  "password_confirmation": "newpass123"
}
→ { "id": 1, "name": "John Doe", ... }
```

**Logout**

```
POST /auth/logout
→ { "message": "Logged out successfully" }
```

### Create Listing

**Create new job posting**

```
POST /listings
{
  "title": "Senior Laravel Developer",
  "company": "Tech Corp",
  "location": "Remote",
  "url": "https://example.com/apply",
  "description": "We're looking for...",
  "tags": [1, 2, 3]  # Tag IDs, optional
}
→ { "id": 123, "title": "...", ... }
```

**Update job posting**

```
PUT /listings/123
{
  "title": "Updated Title",
  "is_active": false,
  ...
}
→ { "id": 123, ... }
```

**Delete job posting**

```
DELETE /listings/123
→ { "message": "Listing deleted successfully" }
```

### Applications

**Get my applications**

```
GET /applications
→ {
  "data": [
    {
      "id": 1,
      "listing_id": 123,
      "message": "I'm interested...",
      "created_at": "2026-02-15T10:00:00Z"
    }
  ]
}
```

**Apply to a job**

```
POST /listings/123/apply
{
  "message": "I'm very interested in this position..."
}
→ { "id": 1, "listing_id": 123, "message": "..." }
```

**Get applications to my job**

```
GET /listings/123/applications
→ {
  "data": [
    {
      "id": 1,
      "user": { "id": 2, "name": "Applicant", "email": "..." },
      "message": "...",
      "created_at": "..."
    }
  ]
}
```

### Ratings

**Rate a listing**

```
POST /listings/123/rate
{
  "rating": 5,
  "comment": "Great company to work with!"  # optional
}
→ { "id": 1, "listing_id": 123, "rating": 5, "comment": "..." }
```

**Get my ratings**

```
GET /ratings
→ {
  "data": [
    {
      "id": 1,
      "listing_id": 123,
      "rating": 5,
      "comment": "...",
      "created_at": "..."
    }
  ]
}
```

### Analytics

**Track click on listing**

```
POST /listings/123/click
→ { "message": "Click tracked successfully" }
```

---

## HTTP Status Codes

| Code | Meaning                                           |
| ---- | ------------------------------------------------- |
| 200  | OK - Request successful                           |
| 201  | Created - Resource created                        |
| 400  | Bad Request - Invalid input                       |
| 401  | Unauthorized - Token missing/invalid              |
| 403  | Forbidden - Not allowed (not owner)               |
| 404  | Not Found - Resource doesn't exist                |
| 409  | Conflict - Already exists (duplicate application) |
| 422  | Unprocessable Entity - Validation failed          |
| 500  | Server Error - Internal error                     |

---

## Error Response Format

```json
{
    "error": "The provided credentials are incorrect.",
    "message": "Error description"
}
```

Or validation error:

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password must be at least 8 characters."]
    }
}
```

---

## cURL Examples

### Register

```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name":"John",
    "email":"john@example.com",
    "password":"password123",
    "password_confirmation":"password123"
  }'
```

### Login

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password123"}'
```

### Get Listings (with token)

```bash
curl http://localhost:8000/api/listings \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Create Listing

```bash
curl -X POST http://localhost:8000/api/listings \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "title":"Senior Developer",
    "company":"Tech Corp",
    "location":"Remote",
    "url":"https://example.com/apply",
    "description":"Job description here...",
    "tags":[1,2]
  }'
```

### Apply to Job

```bash
curl -X POST http://localhost:8000/api/listings/123/apply \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"message":"I am interested in this position..."}'
```

### Rate Listing

```bash
curl -X POST http://localhost:8000/api/listings/123/rate \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{"rating":5,"comment":"Great company!"}'
```

---

## JavaScript Fetch Examples

### Login and Use Token

```javascript
// Login
const loginRes = await fetch("http://localhost:8000/api/auth/login", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
        email: "john@example.com",
        password: "password123",
    }),
});

const { token, user } = await loginRes.json();
localStorage.setItem("token", token);

// Get listings with token
const listingsRes = await fetch("http://localhost:8000/api/listings", {
    headers: { Authorization: `Bearer ${token}` },
});

const listings = await listingsRes.json();
```

### Create Listing

```javascript
const token = localStorage.getItem("token");

const res = await fetch("http://localhost:8000/api/listings", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify({
        title: "Senior Developer",
        company: "Tech Corp",
        location: "Remote",
        url: "https://example.com/apply",
        description: "Job description...",
        tags: [1, 2],
    }),
});

const listing = await res.json();
```

---

## Pagination

All list endpoints support pagination:

```
GET /listings?page=1
GET /applications?page=2
GET /ratings?page=3
```

Response includes:

```json
{
  "data": [...],
  "current_page": 1,
  "last_page": 5,
  "total": 100,
  "per_page": 20
}
```

---

## Search

```
GET /search?q=developer
GET /listings?tag=laravel
GET /listings?tag=laravel&page=2
```

---

## Tips

1. **Save token after login** - You'll need it for all protected endpoints
2. **Include token in Authorization header** - Format: `Bearer {token}`
3. **Always use Content-Type: application/json** - For POST/PUT requests
4. **Check status codes** - Different codes mean different outcomes
5. **Validate before sending** - Check required fields in request body
6. **Handle errors gracefully** - Parse error responses in your app
7. **Implement token refresh** - Tokens may expire in production
8. **Use HTTPS in production** - Never send tokens over plain HTTP

---

**Need help?** Check [MULTIPLATFORM.md](./MULTIPLATFORM.md) or [openapi.json](./openapi.json)
