<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Rute Katalog Utama Toko (Tanpa Login)
Route::get('/', [ProductController::class, 'allProducts'])->name('products.all');

// Kelompok Rute Terproteksi (Wajib Login)
Route::middleware('auth')->group(function () {
    
    // 1. Halaman utama Dashboard Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 2. Jalur data Produk Admin -> URL: /dashboard/products
    Route::get('/dashboard/products', [ProductController::class, 'index'])->name('admin.products.index');

    // 3. Jalur data Kategori Admin -> URL: /dashboard/product-categories
    Route::get('/dashboard/product-categories', [CategoryController::class, 'index'])->name('admin.categories.index');

    // Rute bawaan Breeze Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';