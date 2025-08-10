# 1. Clone the repository
git clone [repository-link]
cd [project-folder]

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Copy environment file and configure it
cp .env.example .env
# Update the .env file with your database credentials

# 5. Generate application key
php artisan key:generate

# 6. Run migrations and seed the database
php artisan migrate --seed

# 7. Build frontend assets
npm run dev  # or npm run build for production

# 8. Start the development server
php artisan serve
