<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return ('ini halaman products');
});

Route::get('/users', function() {
    return 'ini halaman users.';
});

// Route untuk mengelola produk
Route::resource('produk', ProductController::class);

// Route untuk mengelola halaman
Route::resource('halaman', PageController::class);

