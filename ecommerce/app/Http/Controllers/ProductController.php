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

    // fungsi untuk halaman daftar produk (Sudah ditambahkan Request $request)
    public function allProducts(Request $request)
    {
        // 1. Mulai kueri dasar produk beserta relasi kategorinya
        $query = Product::with('category');

        // 2. Cek apakah ada parameter 'category' di URL (Contoh: ?category=1)
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 3. Ambil datanya dan batasi 6 produk per halaman
        $semuaProduk = $query->paginate(6);
        
        // 4. Mengirim data produk ke view 'products'
        return view('products', ['products' => $semuaProduk]);
    }
}