# 🚀 Deployment Guide for Temporary Testing

## Quick Deployment Options

### Option 1: Railway (Recommended - Free)

1. Go to [railway.app](https://railway.app)
2. Sign up with GitHub
3. Click "New Project" → "Deploy from GitHub repo"
4. Select your repository
5. Railway will automatically detect Laravel and deploy
6. Get your live URL in minutes!

### Option 2: Render (Free Tier)

1. Go to [render.com](https://render.com)
2. Sign up with GitHub
3. Click "New" → "Web Service"
4. Connect your GitHub repository
5. Use the `render.yaml` file for configuration
6. Deploy and get your live URL

### Option 3: Heroku (Free Tier)

1. Install Heroku CLI: `brew install heroku/brew/heroku`
2. Login: `heroku login`
3. Create app: `heroku create your-app-name`
4. Deploy: `git push heroku main`
5. Set environment: `heroku config:set APP_KEY=$(php artisan key:generate --show)`

### Option 4: Local Docker (If you have Docker)

1. Install Docker Desktop
2. Run: `docker-compose up -d`
3. Access at: `http://localhost:8000`

## Environment Variables to Set

```bash
APP_NAME="Your App Name"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Security
SESSION_SECURE_COOKIE=true
DEMO=false
```

## Pre-Deployment Checklist

✅ All security fixes applied
✅ Database transactions implemented
✅ Rate limiting configured
✅ Error logging added
✅ Input validation enhanced
✅ CSRF protection configured

## Post-Deployment Steps

1. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

2. **Run Migrations:**

    ```bash
    php artisan migrate
    ```

3. **Clear Caches:**

    ```bash
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear
    ```

4. **Set Permissions:**

    ```bash
    chmod -R 755 storage bootstrap/cache
    ```

5. **Test Critical Functions:**
    - User registration/login
    - Money transfers
    - Withdrawals
    - File uploads
    - Payment processing

## Monitoring & Debugging

1. **Check Logs:**

    ```bash
    tail -f storage/logs/laravel.log
    ```

2. **Enable Debug Mode (if needed):**

    ```bash
    APP_DEBUG=true
    ```

3. **Monitor Rate Limiting:**
    - Check for 429 errors
    - Monitor user activity

## Security Reminders

⚠️ **Important Security Notes:**

-   Change default admin credentials
-   Use strong database passwords
-   Enable HTTPS in production
-   Monitor for suspicious activity
-   Regular backups
-   Keep dependencies updated

## Support

If you encounter issues:

1. Check the logs: `storage/logs/laravel.log`
2. Enable debug mode temporarily
3. Verify environment variables
4. Check database connectivity
5. Test with a fresh database

## Quick Test URLs

After deployment, test these endpoints:

-   `/` - Home page
-   `/user/login` - User login
-   `/admin/login` - Admin login
-   `/user/register` - User registration
-   `/user/dashboard` - User dashboard (after login)
