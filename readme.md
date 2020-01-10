## Steps to install

- open CMD

- Step1: git clone https://github.com/milansoni44/Laravel.git

- Step2: cd Laravel

- Step3:
app\Providers\AppServiceProvider.php
Comment below lines
```php
//$settings = Setting::all()[0];
//view()->share('settings', $settings);
```

- Step4: composer install

- Step5: rename .env.example .env

- Step6: Create Databse 

- Step7: change databse credentials in .env file

- Step8: php artisan key:generate
- Step9: php artisan migrate

- Step10: php artisan db:seed --class=RolesTableSeeder
- Step11: php artisan db:seed --class=SettingsTableSeeder
- Step12: php artisan db:seed --class=UsersTableSeeder

- Step13: 
app\Providers\AppServiceProvider.php
UnComment below lines
```php
$settings = Setting::all()[0];
view()->share('settings', $settings);
```

- Step14: 
php artisan serve

- Step15:
Login with  
Username: admin@gmail.com  
Password: admin 

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
