<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. GUEST ROUTES: Hanya untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 2. AUTH ROUTES: Terproteksi, wajib login terlebih dahulu
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/transactions', [TransactionController::class, 'Transaction'])->name('transaction');
    Route::post('/transactions', [TransactionController::class, 'Store'])->name('transaction.store');
    
    Route::get('/categories', [CategoryController::class, 'Category'])->name('cartegories');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});