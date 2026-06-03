<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // fungsi untuk halaman utama
    public function index()
    {
        return view('home');
    }

    //fungsi untuk halaman daftar produk
    public function allProducts()
    {
        // mengambil semua produk beserta kategori-nya, lalu paginasi 6 produk per halaman
        $semuaProduk = Product::with('category')->paginate(6);
        
        // mengirim data produk ke view 'products'
        return view('products', ['products' => $semuaProduk]);
    }
}