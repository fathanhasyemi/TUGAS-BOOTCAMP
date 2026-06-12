<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Ditambahkan agar aman jika sewaktu-waktu pakai query builder biasa
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * FUNGSI ADMIN: Menampilkan tabel manajemen produk di Dashboard
     * URL: /dashboard/products
     */
    public function index(Request $request)
    {
        // 1. Ambil kata kunci dari input search di URL (misal: ?search=sepatu)
        $search = $request->input('search');

        // 2. Ambil data produk dengan Eager Loading 'category' agar load-nya cepat
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                // Jika ada kata kunci, saring nama produk atau deskripsi yang mirip
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        // 3. Kirim data produk ke halaman admin index
        return view('product.admin_index', compact('products'));
    }

    /**
     * FUNGSI PUBLIK: Menampilkan halaman katalog toko untuk pembeli
     * URL: / atau /products
     */
    public function allProducts(Request $request)
    {
        // 1. Mulai kueri dasar produk beserta relasi kategorinya
        $query = Product::with('category');

        // 2. Cek apakah ada parameter 'category' di URL (Contoh: ?category=1)
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 3. Ambil datanya dan batasi 12 produk per halaman
        $semuaProduk = $query->paginate(12);
        
        // 4. Mengirim data produk ke view katalog 'products.blade.php'
        return view('products', ['products' => $semuaProduk]);
    }

    // --- TAMBAHAN SESI 8 (Langkah 6) ---

    /**
     * Menampilkan halaman formulir tambah produk baru
     */
    public function create()
    {
        // Mengambil semua data kategori dari database untuk pilihan dropdown di form
        $categories = Category::all();

        // Mengarahkan ke file view: resources/views/product/create.blade.php
        return view('product.create', compact('categories'));
    }

    /**
     * Menampilkan halaman formulir edit produk lama berdasarkan ID
     */
    public function edit($id)
    {
        // 1. Cari data produk yang mau diedit, jika tidak ada langsung memunculkan error 404
        $product = Product::findOrFail($id);

        // 2. Ambil semua data kategori untuk pilihan dropdown di form edit
        $categories = Category::all();

        // Mengarahkan ke file view: resources/views/product/edit.blade.php
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * FUNGSI PUBLIK: Menampilkan halaman detail produk
     * URL: /products/{id}
     */
    public function show($id)
    {
        // Ambil data produk berdasarkan ID menggunakan Eloquent Model (mencari ke tabel 'products')
        $product = Product::find($id);

        // Jika produk tidak ditemukan di database, kembalikan ke halaman katalog dengan pesan error
        if (!$product) {
            return redirect('/products')->with('error', 'Produk tidak ditemukan!');
        }

        // 💡 FITUR BARU: Tambah jumlah klik/views sebanyak 1 setiap kali halaman detail dibuka
        $product->increment('views');

        // Jika ada, kirim data produk tersebut ke view 'show.blade.php'
        return view('show', compact('product'));
    }
}