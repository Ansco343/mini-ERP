<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollectionIterator;

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login'. [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'shouwRegister'])->name('register');
    Route::get('/register'. [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function (){
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/transactions', [TransactionController::class, 'Transaction'] )->name('transaction');
    Route::post('/transations', [TransactionController::class, 'Store'])->name('transaction.store');

    Route::get('/categories', [CategoryController::class, 'Category'])->name('cartegories');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});