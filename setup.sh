#!/bin/bash

echo "🚀 Laravel Application Setup Script"
echo "=================================="

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel root directory."
    exit 1
fi

echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

echo "🔑 Generating application key..."
php artisan key:generate

echo "🗄️ Running database migrations..."
php artisan migrate --force

echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "📁 Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "✅ Setup complete!"
echo ""
echo "🌐 Your application is ready for deployment!"
echo "📋 Next steps:"
echo "   1. Set up your environment variables"
echo "   2. Configure your database"
echo "   3. Set up your web server"
echo "   4. Test your application"
echo ""
echo "📖 See DEPLOYMENT_GUIDE.md for detailed instructions" 