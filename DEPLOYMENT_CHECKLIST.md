# Multiplatform Deployment Checklist

## ✅ Pre-Deployment

- [ ] All tests passing: `php artisan test`
- [ ] No PHP errors: `php artisan tinker`
- [ ] Database migrations complete: `php artisan migrate:status`
- [ ] API endpoints tested with curl/Postman
- [ ] CORS origins configured correctly in `.env`
- [ ] Environment set to production: `APP_ENV=production`
- [ ] Debug mode disabled: `APP_DEBUG=false`

## ✅ Backend Deployment (Laravel)

### Server Setup

- [ ] PHP 8.2+ installed
- [ ] MySQL/MariaDB running
- [ ] Composer installed
- [ ] Node.js installed (for asset compilation)
- [ ] SSL certificate installed (HTTPS required)

### Application Setup

```bash
# Clone repository
git clone <repo-url>
cd job-board-test

# Install dependencies
composer install --optimize-autoloader --no-dev
npm ci
npm run build

# Configuration
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate --force
php artisan db:seed

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Environment Variables

```env
APP_NAME=JobHub
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=db-host
DB_PORT=3306
DB_DATABASE=jobboard
DB_USERNAME=dbuser
DB_PASSWORD=secure-password

# CORS - Add all your client domains
CORS_ALLOWED_ORIGINS=https://your-domain.com,https://app.your-domain.com,https://www.your-domain.com

# Mail (if using email notifications)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@your-domain.com

# Session
SESSION_DRIVER=database
CACHE_DRIVER=redis

# Queue (optional)
QUEUE_CONNECTION=database

# Sanctum (API tokens)
SANCTUM_STATEFUL_DOMAINS=your-domain.com,app.your-domain.com
```

### Web Server Configuration (Nginx)

```nginx
server {
    listen 443 ssl http2;
    server_name your-domain.com;

    ssl_certificate /path/to/ssl/cert;
    ssl_certificate_key /path/to/ssl/key;

    root /var/www/job-board-test/public;

    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    index index.php index.html index.htm;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}

# Redirect HTTP to HTTPS
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}
```

### Web Server Configuration (Apache)

Ensure `.htaccess` is in place (Laravel includes one) and enable `mod_rewrite`:

```bash
a2enmod rewrite
systemctl restart apache2
```

### Monitoring & Logging

```bash
# View application logs
tail -f storage/logs/laravel.log

# Monitor background jobs (if using queue)
php artisan queue:listen

# Monitor scheduled tasks
php artisan schedule:run

# Enable error logging in `.env`
APP_LOG=stack
LOG_CHANNEL=stack
```

## ✅ Mobile Apps Deployment

### React Native (Expo)

```bash
# Build for iOS
eas build --platform ios

# Build for Android
eas build --platform android

# Submit to app stores
eas submit --platform ios
eas submit --platform android
```

### React Native (Native)

```bash
# iOS
cd ios
pod install
xcode-build...

# Android
cd android
./gradlew assembleRelease
```

### Flutter

```bash
# iOS
flutter build ios --release

# Android
flutter build appbundle --release

# Upload to stores
# Use Play Store Console for Android
# Use Xcode/App Store Connect for iOS
```

### Configuration for Production

Update API base URL:

```typescript
// React Native
const API_URL = 'https://your-domain.com/api';

// Flutter
const String API_URL = 'https://your-domain.com/api';
```

## ✅ SPA (React/Vue) Deployment

### Build

```bash
npm run build
# Creates dist/ folder
```

### Deploy to Hosting

- Vercel: `vercel deploy`
- Netlify: `netlify deploy --prod`
- AWS S3 + CloudFront: Use AWS CLI
- GitHub Pages: Use gh-pages

### Environment Variables

```env
REACT_APP_API_URL=https://your-domain.com/api
```

## ✅ Database

- [ ] Backup before migration
- [ ] Run migrations in order
- [ ] Verify data integrity
- [ ] Test rollback procedure

```bash
# Backup
mysqldump -u user -p database > backup.sql

# Restore from backup
mysql -u user -p database < backup.sql
```

## ✅ Security Checklist

- [ ] HTTPS enabled (SSL/TLS)
- [ ] CORS properly configured (not `*`)
- [ ] Rate limiting enabled
- [ ] API keys secured (not in version control)
- [ ] Database credentials in environment variables
- [ ] File permissions correct (storage, config)
- [ ] Sensitive routes authenticated
- [ ] SQL injection prevention (using ORM)
- [ ] XSS protection enabled (in responses)
- [ ] CSRF tokens validated
- [ ] Regular security updates (`composer update`)
- [ ] Secrets not committed to git
- [ ] Database backups automated
- [ ] Logs monitored for errors
- [ ] Firewalls configured

## ✅ Performance Optimization

- [ ] Assets minified and cached
- [ ] Database indexes created
- [ ] Query N+1 problems solved
- [ ] API response times < 200ms
- [ ] CDN configured for static assets
- [ ] Gzip compression enabled
- [ ] Browser caching headers set
- [ ] Database connection pooling
- [ ] Rate limiting configured

## ✅ Monitoring & Alerts

Set up monitoring for:

- [ ] Server uptime
- [ ] API response times
- [ ] Database performance
- [ ] Error logs
- [ ] Memory/CPU usage
- [ ] Disk space

## ✅ Post-Deployment

- [ ] Smoke test all endpoints
- [ ] Verify mobile app connectivity
- [ ] Check web UI functionality
- [ ] Monitor logs for errors
- [ ] Test authentication flows
- [ ] Load testing completed
- [ ] User acceptance testing passed
- [ ] Backup automation verified

## 📞 Support & Rollback

### If Issues Occur

1. Check logs: `tail -f storage/logs/laravel.log`
2. Verify database connectivity
3. Check API health: `GET /api/health`
4. Review recent deployment changes
5. Rollback if necessary:
    ```bash
    git revert HEAD
    php artisan migrate:rollback
    ```

### Update Procedure

```bash
git pull origin main
composer install
npm ci && npm run build
php artisan migrate
php artisan cache:clear
php artisan queue:restart
```

---

**Deployment Date:** ******\_\_\_******
**Deployed By:** ******\_\_\_******
**Status:** ******\_\_\_******
**Notes:** ******\_\_\_******
