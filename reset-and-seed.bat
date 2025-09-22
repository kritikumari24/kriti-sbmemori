@echo off
echo Resetting database and seeding with roles...

echo.
echo 1. Refreshing migrations...
php artisan migrate:refresh

echo.
echo 2. Seeding database...
php artisan db:seed

echo.
echo 3. Clearing cache...
php artisan cache:clear

echo.
echo Setup complete!
echo.
echo Login credentials:
echo Admin: admin@gmail.com / 123456
echo Staff: staff@example.com / password  
echo Parent: parent@example.com / password
echo.
pause