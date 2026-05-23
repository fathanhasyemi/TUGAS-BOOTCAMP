<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;

// 1. Halaman Utama dipanggil lewat PageController
Route::get('/', [PageController::class, 'index']);

// 2. Halaman Keranjang dipanggil lewat PageController
Route::get('/keranjang', [PageController::class, 'cart']);

// 3. Halaman Daftar Produk dipanggil lewat ProductController
Route::get('/produk', [ProductController::class, 'index']);