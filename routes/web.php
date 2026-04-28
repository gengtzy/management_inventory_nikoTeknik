<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| ROUTE OTENTIKASI (LOGIN & LOGOUT)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| ROUTE APLIKASI (HANYA BISA DIAKSES JIKA SUDAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('items', ItemController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('technicians', TechnicianController::class);
    Route::resource('inbounds', InboundController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('services', ServiceController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});