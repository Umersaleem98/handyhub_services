<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
// LOGIN PAGE
Route::get('/login', [AuthController::class, 'LoginScreen'])->name('login');

// LOGIN FUNCTION
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'RegisterScreen'])->name('auth.register');

Route::post('/register/store', [AuthController::class, 'Register'])->name('register.store');

// DASHBOARD
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');