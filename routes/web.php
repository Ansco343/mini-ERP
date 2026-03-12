<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () { return redirect()->route('dashboard'); });

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction');
Route::get('/categories', [CategoryController::class, 'index'])->name('cartegories');