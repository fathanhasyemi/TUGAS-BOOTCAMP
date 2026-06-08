<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori beserta jumlah produknya.
     */
    public function index()
    {
        // Mengambil seluruh kategori lengkap dengan hitungan kolom dinamis 'products_count'
        $categories = Category::withCount('products')->get();

        // Diarahkan ke file view: resources/views/categories/index.blade.php
        return view('categories.index', compact('categories'));
    }
}