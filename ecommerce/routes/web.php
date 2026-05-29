<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;

// 1. Halaman Utama dipanggil lewat PageController
Route::get('/', [PageController::class, 'index']);

// 2. Halaman Keranjang dipanggil lewat PageController
Route::get('/cart', [PageController::class, 'cart']);

// 3. Halaman Daftar Produk dipanggil lewat ProductController
Route::get('/products', [ProductController::class, 'index']);