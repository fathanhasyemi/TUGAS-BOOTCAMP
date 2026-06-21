<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung data lama yang sudah ada sebelumnya
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        // 2. 💡 TAMBAHAN TUGAS BARU: Menghitung total klik (views) dari seluruh produk
        $totalClicks = Product::sum('views');

        // 3. Kirim semua data (Lama + Baru) ke view dashboard admin
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalUsers', 'totalClicks'));
    }
}