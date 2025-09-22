@echo off
echo Setting up role-based system...

echo.
echo 1. Running migrations...
php artisan migrate

echo.
echo 2. Seeding database with new roles...
php artisan db:seed --class=RoleSeeder

echo.
echo 3. Creating sample users for each role...
php artisan db:seed --class=UpdateUserSeeder

echo.
echo 4. Clearing cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo Setup complete!
echo.
echo Sample login credentials:
echo Admin: admin@example.com / password
echo Staff: staff@example.com / password  
echo Parent: parent@example.com / password
echo.
echo Access URLs:
echo Admin: http://localhost:9000/admin/login
echo Regular Login: http://localhost:9000/login
echo.
pause