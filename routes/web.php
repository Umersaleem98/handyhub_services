<?php

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\UserVerificationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Provider\ProviderProfileController;
use App\Http\Controllers\Seeker\SeekerProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');



/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// LOGIN PAGE
Route::get('/login', [AuthController::class, 'LoginScreen'])
    ->name('login');

// LOGIN FUNCTION
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');


// REGISTER PAGE
Route::get('/register', [AuthController::class, 'RegisterScreen'])
    ->name('auth.register');


// REGISTER FUNCTION
Route::post('/register/store', [AuthController::class, 'Register'])
    ->name('register.store');


// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');



/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {



    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');



Route::middleware(['auth'])->prefix('admin')->group(function () {

Route::get('/users', [UserVerificationController::class, 'index'])->name('admin.users');
Route::get('/users/{id}', [UserVerificationController::class, 'show'])->name('admin.users.show');
Route::post('/users/{id}/verify',[UserVerificationController::class, 'verify'])->name('admin.users.verify');
Route::post('/users/{id}/unverify',[UserVerificationController::class, 'unverify'])->name('admin.users.unverify');
});


    /*
    |--------------------------------------------------------------------------
    | SEEKER PROFILE ROUTES
    |--------------------------------------------------------------------------
    */

    Route::prefix('seeker')->name('seeker.')->group(function () {

        // PROFILE PAGE
        Route::get('/profile', [SeekerProfileController::class, 'index'])->name('profile');
        // STORE / UPDATE PROFILE
        Route::post('/profile/store', [SeekerProfileController::class, 'store'])->name('profile.store');
    });



    /*
    |--------------------------------------------------------------------------
    | PROVIDER PROFILE ROUTES
    |--------------------------------------------------------------------------
    */

    Route::prefix('provider')->name('provider.')->group(function () {

        // PROFILE PAGE
        Route::get('/profile', [ProviderProfileController::class, 'index'])->name('profile');
        // STORE / UPDATE PROFILE
        Route::post('/profile/store', [ProviderProfileController::class, 'store'])->name('profile.store');
    });
});