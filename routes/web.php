<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('dashboard'); });

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/transactions', function () {
    return view('transactions');
});

Route::get('/categories', function () {
    return view('categories'); // Fitur Rekomendasi: Manajemen Kategori
});