<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// hubungkan rute halaman utama dengan fungsi index di ProductController
Route::get('/', [ProductController::class, 'index']);

// hubungkan rute halaman daftar produk dengan fungsi allProducts di ProductController
Route::get('/products', [ProductController::class, 'allProducts']);

// hubungkan rute halaman keranjang dengan fungsi cart di OrderController
Route::get('/cart', [OrderController::class, 'cart']);

// hubungkan rute halaman checkout dengan fungsi checkout di OrderController
Route::get('/checkout', [OrderController::class, 'checkout']);

