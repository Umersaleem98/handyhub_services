<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Seeker\DashboardController as SeekerDashboard;
use App\Http\Controllers\Seeker\ServiceRequestController;
use App\Http\Controllers\Seeker\BookingController as SeekerBooking;
use App\Http\Controllers\Provider\DashboardController as ProviderDashboard;
use App\Http\Controllers\Provider\ProfileController;
use App\Http\Controllers\Provider\BookingController as ProviderBooking;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\UserController;

// ==================== PUBLIC ROUTES ====================

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==================== AUTH ROUTES (GUEST ONLY) ====================

Route::middleware(['guest'])->group(function () {
    
    // Seeker Auth
    Route::get('/seeker/login', [LoginController::class, 'showSeekerLogin'])->name('seeker.login');
    Route::post('/seeker/login', [LoginController::class, 'seekerLogin'])->name('seeker.login.post');
    Route::get('/seeker/register', [RegisterController::class, 'showSeekerRegister'])->name('seeker.register');
    Route::post('/seeker/register', [RegisterController::class, 'seekerRegister'])->name('seeker.register.post');

    // Provider Auth
    Route::get('/provider/login', [LoginController::class, 'showProviderLogin'])->name('provider.login');
    Route::post('/provider/login', [LoginController::class, 'providerLogin'])->name('provider.login.post');
    Route::get('/provider/register', [RegisterController::class, 'showProviderRegister'])->name('provider.register');
    Route::post('/provider/register', [RegisterController::class, 'providerRegister'])->name('provider.register.post');

    // Admin Auth
    Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.post');
});

// Logout (Accessible by all authenticated users)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ==================== SEEKER ROUTES ====================

Route::middleware(['auth', 'role:seeker'])->prefix('seeker')->name('seeker.')->group(function () {
    Route::get('/dashboard', [SeekerDashboard::class, 'index'])->name('dashboard');
    
    Route::get('/requests/create', [ServiceRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [ServiceRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests', [ServiceRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{serviceRequest}/quotes', [ServiceRequestController::class, 'quotes'])->name('requests.quotes');
    Route::post('/requests/{serviceRequest}/accept-quote', [ServiceRequestController::class, 'acceptQuote'])->name('requests.accept-quote');
    
    Route::get('/bookings', [SeekerBooking::class, 'index'])->name('bookings');
});

// ==================== PROVIDER ROUTES ====================

Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderDashboard::class, 'index'])->name('dashboard');
    
    Route::get('/profile/complete', [ProfileController::class, 'showCompleteForm'])->name('profile.complete');
    Route::post('/profile/complete', [ProfileController::class, 'complete'])->name('profile.complete.post');
    
    Route::get('/documents/upload', [ProfileController::class, 'showDocumentsForm'])->name('documents.upload');
    Route::post('/documents/upload', [ProfileController::class, 'uploadDocuments'])->name('documents.upload.post');
    
    Route::get('/bookings', [ProviderBooking::class, 'index'])->name('bookings');
    Route::post('/bookings/{booking}/accept', [ProviderBooking::class, 'accept'])->name('bookings.accept');
    Route::post('/bookings/{booking}/arrive', [ProviderBooking::class, 'markArrived'])->name('bookings.arrive');
    Route::post('/bookings/{booking}/start', [ProviderBooking::class, 'startService'])->name('bookings.start');
    Route::post('/bookings/{booking}/complete', [ProviderBooking::class, 'complete'])->name('bookings.complete');
});

// ==================== ADMIN ROUTES ====================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    Route::get('/verifications/pending', [VerificationController::class, 'pending'])->name('verifications.pending');
    Route::post('/documents/{document}/review', [VerificationController::class, 'review'])->name('documents.review');
    
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
});