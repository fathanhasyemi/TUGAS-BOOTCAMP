<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Bisa Diakses Tanpa Login)
|--------------------------------------------------------------------------
*/

// Halaman Utama Toko / Katalog Utama
Route::get('/', [PageController::class, 'index'])->name('home');

// Tampilkan Semua Produk & Detail Produk
Route::get('/products', [ProductController::class, 'allProducts'])->name('products.all');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Sistem Keranjang Belanja (Cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/remove-from-cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout & Order + Profile umum (login saja)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // --- PROFILE BAWAAN BREEZE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| 2. RUTE ADMIN (Wajib Login & Menggunakan Layout Dashboard Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    
    // --- DASHBOARD UTAMA ---
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update');

    // 💡 RUTE PENYELAMAT 1: Biar file layout lama gak eror nyariin 'admin.dashboard'
    Route::get('/admin/dashboard', function () {
        return redirect()->route('dashboard');
    })->name('admin.dashboard');


    // --- MANAJEMEN PRODUK (URL: /dashboard/products) ---
    Route::get('/dashboard/products', [ProductController::class, 'index'])->name('products.index');
    
    // 💡 RUTE PENYELAMAT 2: Biar tombol lama yang manggil 'admin.products.index' tetep jalan
    Route::get('/admin/products-list', [ProductController::class, 'index'])->name('admin.products.index');

    // Operasi CRUD Produk
    Route::get('/dashboard/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/dashboard/products', [ProductController::class, 'store'])->name('product.store'); // Dipakai untuk Sesi 21
    Route::post('/dashboard/products/store-alt', [ProductController::class, 'store'])->name('products.store'); // 💡 JALUR PENYELAMAT BIAR BLADE GA EROR
    Route::get('/dashboard/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/dashboard/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/dashboard/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


    // --- MANAJEMEN KATEGORI (URL: /dashboard/product-categories) ---
    Route::get('/dashboard/product-categories', [CategoryController::class, 'index'])->name('categories.index');
    
    // 💡 RUTE PENYELAMAT 3: Biar menu navigasi sidebar gak eror nyariin 'admin.categories.index'
    Route::get('/admin/categories-list', [CategoryController::class, 'index'])->name('admin.categories.index');

    // Operasi CRUD Kategori
    Route::get('/dashboard/product-categories/create', [CategoryController::class, 'create'])->name('categories.create');
    
    // 💡 TRIPLE ATTACK RUTE PENYELAMAT UNTUK STORE KATEGORI (Menampung semua variasi nama rute dari Blade)
    Route::post('/dashboard/product-categories', [CategoryController::class, 'store'])->name('product-category.store'); 
    Route::post('/dashboard/product-categories/alt-1', [CategoryController::class, 'store'])->name('product-categories.store'); 
    Route::post('/dashboard/product-categories/alt-2', [CategoryController::class, 'store'])->name('categories.store'); 
    
    Route::get('/dashboard/product-categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/dashboard/product-categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/dashboard/product-categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

});

require __DIR__.'/auth.php';