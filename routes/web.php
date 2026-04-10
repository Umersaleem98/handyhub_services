<?php

use App\Http\Controllers\Admin\Client\ClientServicesController;
use App\Http\Controllers\Admin\DashboardControllerr;
use App\Http\Controllers\Auth\AuthControllerr;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

Route::get("dashboard", [DashboardControllerr::class, 'index'] )->name('dashboard');
Route::get("login", [AuthControllerr::class, 'Loginscreen'] )->name('login.index');
Route::get("register", [AuthControllerr::class, 'Regiserscreen'] )->name('register.index');


Route::get("booking/index", [ClientServicesController::class, 'index'] )->name('booking.index');