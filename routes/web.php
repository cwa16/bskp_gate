<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AppLinkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuletinController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainAppController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RecentActivityController;
use App\Http\Controllers\RoleAppController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Register
Route::get('/register', [AuthController::class, 'index'])->name('register');

// Login
Route::get('/', [AuthController::class, 'login_index'])->name('login.index');
Route::post('/login-otp', [AuthController::class, 'login'])->name('login.otp');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// OTP
Route::get('/otp-index', [AuthController::class, 'otp_index'])->name('otp.index');
Route::post('/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/access-app/{id}', [DashboardController::class, 'accessApp'])->name('access.app');

// App List
Route::get('/app-link', [AppLinkController::class, 'index'])->name('app-link-index');
Route::post('/app-link-store', [AppLinkController::class, 'store'])->name('app-link-store');
Route::put('/app-link-update/{id}', [AppLinkController::class, 'update'])->name('app-link-update');
Route::delete('/app-link-delete/{id}', [AppLinkController::class, 'delete'])->name('app-link-delete');

// Activity Log
Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log-index');

// User Account
Route::get('/user-account', [UserController::class, 'index'])->name('user-account-index');
Route::get('/user-account-create', [UserController::class, 'create'])->name('user-account-create');
Route::post('/user-account-create', [UserController::class, 'store'])->name('user-account-store');
Route::get('/user-account-update/{$id}', [UserController::class, 'edit'])->name('user-account-edit');
Route::put('/user-account-update/{$id}', [UserController::class, 'update'])->name('user-account-update');
Route::delete('/user-account-delete/{$id}', [UserController::class, 'delete'])->name('user-account-delete');

// User Role App
Route::get('/user-role', [RoleAppController::class, 'index'])->name('user-role-index');
Route::post('/user-role-store', [RoleAppController::class, 'store'])->name('user-role-store');
Route::put('/user-role-update/{id}', [RoleAppController::class, 'update'])->name('user-role-update');
Route::delete('/user-role-delete/{id}', [RoleAppController::class, 'delete'])->name('user-role-delete');

Route::get('/news', [NewsController::class, 'index'])->name('news-index');

// Recent Activity
Route::get('/recent-activity', [RecentActivityController::class, 'index'])->name('recent-activity-index');

// Buletin
Route::get('/buletin', [BuletinController::class, 'index'])->name('buletin.index');
Route::post('/buletin', [BuletinController::class, 'store'])->name('buletin.store');
