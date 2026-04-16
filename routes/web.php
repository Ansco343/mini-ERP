<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/transactions', [TransactionController::class, 'Transaction'] )->name('transaction');
Route::post('/transations', [TransactionController::class, 'Store'])->name('transaction.store');

Route::get('/categories', [CategoryController::class, 'Category'])->name('cartegories');