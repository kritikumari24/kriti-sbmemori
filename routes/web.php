<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminErrorPageController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/admin/test', 'TestController@test');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::controller(LoginController::class)->middleware('admin.guest')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login.form');
        Route::post('/login', 'login')->name('login');
    });
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/password/reset', 'showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');
        Route::post('/password/reset', 'reset')->name('password.update');
    });

    Route::controller(AdminErrorPageController::class)->group(function () {
        Route::get('/404', 'pageNotFound')->name('notfound');
        Route::get('/500', 'serverError')->name('server_error');
    });
    Route::group(['middleware' => ['admin.auth']], function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/sample-pdf', [DashboardController::class, 'samplePdf'])->name('sample-pdf');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/test', 'test')->name('test');
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('dashboard-counts', 'dashboardCountsData')->name('dashboard-counts');
            Route::get('get-charts-data', 'showChartData')->name('dashboard.get-charts-data');
        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::get('change-password', 'changePassword')->name('change_password');
            Route::put('change-password/{user}', 'updatePassword')->name('update.password');
        });

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('types', TypeController::class);
        Route::get('/types/status/{id}/{status}', [TypeController::class, 'status'])->name('users.status');

        Route::controller(UserController::class)->group(function () {
            Route::get('/update_language/{user}/{language}', 'updateLanguage')->name('users.update_language');
            Route::get('/users/status/{id}/{status}', 'status')->name('users.status');
            Route::post('/users/download', 'export')->name('users.download');
        });
        Route::resource('/users', UserController::class);

        Route::controller(CustomerController::class)->group(function () {
            Route::get('/customers/status/{id}/{status}', 'status')->name('customers.status');
            Route::post('/customers/download', 'export')->name('customers.download');
            Route::get('/customers/download', 'export')->name('customers.getdownload');
        });
        Route::resource('/customers', CustomerController::class);

        Route::controller(ProductController::class)->group(function () {
            Route::get('/products/status/{id}/{status}', 'status')->name('products.status');
            Route::post('/products/download', 'export')->name('products.download');
            Route::get('/products/download', 'export')->name('products.getdownload');
            Route::post('/products/import', 'import')->name('products.import');
            Route::get('products/get-format-files', 'downloadImportFormatFile')->name('products.getfile');
            Route::delete('products/delete-images/{id}', 'deleteImage')->name('products.delete_image');
        });
        Route::resource('/products', ProductController::class);

        //Setting manager
        Route::controller(SettingController::class)->group(function () {
            Route::get('/settings/general', 'edit_general')->name('settings.edit_general');
            Route::post('/settings/general', 'update_general')->name('settings.update_general');
        });

        //Admin PageContent
        Route::get('/page-contents/status/{id}/{status}', [PageContentController::class, 'status']);
        Route::resource('page-contents', PageContentController::class);

        //Admin Faq
        // Route::middleware('role_or_permission:faq-list')->group(function () {
        Route::controller(FaqController::class)->group(function () {
            Route::get('/faqs/status/{id}/{status}', 'status')->name('faqs.status');
            Route::post('/faqs/download', 'export')->name('faqs.download');
            Route::get('/faqs/download', 'export')->name('faqs.getdownload');
        });
        Route::resource('faqs', FaqController::class);
        // });

        //PushNotification controller
        Route::controller(PushNotificationController::class)->group(function () {
            Route::get('/pushNotifications/getUserByName', 'getUserByName')->name('pushNotifications.getByName');
            Route::get('/pushNotifications/status/{id}/{status}', 'status');
        });
        Route::resource('/pushNotifications', PushNotificationController::class);

        //Contact Us
        Route::controller(ContactUsController::class)->group(function () {
            Route::get('/contact-us/status/{id}/{status}', 'status')->name('contact-us.status');
        });
        Route::resource('/contact-us', ContactUsController::class);
    });
});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('optimize:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    return 'DONE'; //Return anything
});
