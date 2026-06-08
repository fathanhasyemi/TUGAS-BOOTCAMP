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


    // --- RUTE MANAJEMEN KATEGORI ---
    // Halaman Form Tambah Kategori
    Route::get('/dashboard/product-categories/create', [CategoryController::class, 'create'])->name('categories.create');
    
    // Proses Simpan Kategori Baru
    Route::post('/dashboard/product-categories', [CategoryController::class, 'store'])->name('categories.store');
    
    // Halaman Form Edit Kategori
    Route::get('/dashboard/product-categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    
    // Proses Update Kategori Lama
    Route::put('/dashboard/product-categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    // Proses Hapus Kategori
    Route::delete('/dashboard/product-categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // --- RUTE MANAJEMEN PRODUK ---
    // Halaman Form Tambah Produk
    Route::get('/dashboard/products/create', [ProductController::class, 'create'])->name('products.create');
    
    // Proses Simpan Produk Baru
    Route::post('/dashboard/products', [ProductController::class, 'store'])->name('products.store');
    
    // Halaman Form Edit Produk
    Route::get('/dashboard/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    
    // Proses Update Data Produk Lama
    Route::put('/dashboard/products/{id}', [ProductController::class, 'update'])->name('products.update');

    // Proses Hapus Produk
    Route::delete('/dashboard/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


    // Rute bawaan Breeze Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';