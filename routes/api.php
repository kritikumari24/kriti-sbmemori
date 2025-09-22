<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\Customer\AuthController;
use App\Http\Controllers\Api\V1\Manager\TestController as ManagerTestController;
use App\Http\Controllers\Api\V1\Customer\TestController as CustomerTestController;
use App\Http\Controllers\Api\V1\Vendor\AuthController as VendorAuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatWithRoleController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/v1/test', [TestController::class, 'test'])->middleware('log.requests');

Route::group(['prefix' => 'v1/chat', 'as' => 'chat'], function () {
    Route::controller(ChatController::class)->group(function () {
        Route::get('/users', 'index');
        Route::post('/user/{user}', 'store');
        Route::get('/user/{user}/active-chats', 'getActiveChats');
        Route::post('/user-chat-history', 'getChatHistory');
    });
    
});

Route::group(['prefix' => 'v1/role-chat/', 'as' => 'chat'], function () {
    Route::controller(ChatWithRoleController::class)->group(function () {
        Route::get('/users', 'index');
        Route::post('/user', 'store');
        Route::get('/user/{user}/active-chats', 'getActiveChats');
        Route::post('/user-chat-history', 'getChatHistory');
    });
    
});
Route::group(['prefix' => '/v1/manager', 'middleware' => 'log.requests'], function () {
    Route::get('/test', [ManagerTestController::class, 'test']);
});

Route::group(['prefix' => '/v1/customer', 'middleware' => 'log.requests'], function () {
    Route::get('/test', [CustomerTestController::class, 'test']);

    // -------- Register And Login API ----------
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'authMobileCheck');
        Route::post('login-otp', 'authWithOtp');
    });

    // -------- Register And Login API ----------
    Route::group(['middleware' => ['jwt.auth']], function () {
        /* Profile Controller */
        Route::controller(AuthController::class)->group(function () {
            Route::post('logout', 'logout');
        });
    });
});

Route::group(['prefix' => '/v1/vendor', 'middleware' => 'log.requests'], function () {


    // -------- Register And Login API ----------
    Route::controller(VendorAuthController::class)->group(function () {
        Route::post('login', 'authMobileCheck');
        Route::post('login-otp', 'authWithOtp');
    });

    // -------- Register And Login API ----------
    Route::group(['middleware' => ['jwt.auth']], function () {
        /* Profile Controller */
        Route::controller(VendorAuthController::class)->group(function () {
            Route::post('logout', 'logout');
        });
    });
});