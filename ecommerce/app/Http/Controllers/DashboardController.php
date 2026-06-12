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
        // Menghitung jumlah total data langsung dari database
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        // Mengirim data hitungan ke view dashboard admin
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalUsers'));
    }
}