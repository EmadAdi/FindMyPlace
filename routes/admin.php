<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PropertyRequestController;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;

 // 🚫 صفحات تسجيل الدخول يجب أن تكون خارج auth
     Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
     });
     Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::resource('properties', PropertyController::class);
        Route::resource('discounts', DiscountController::class);
        Route::resource('users', UserController::class)->only(['index', 'destroy']);
        Route::resource('bookings', BookingController::class)->except(['show', 'edit', 'update']);

        Route::get('propertyrequest', [PropertyRequestController::class, 'index'])->name('orders.index');
        Route::post('propertyrequest/{order}/approve', [PropertyRequestController::class, 'approve'])->name('orders.approve');
        Route::post('propertyrequest/{order}/reject', [PropertyRequestController::class, 'reject'])->name('orders.reject');
     });