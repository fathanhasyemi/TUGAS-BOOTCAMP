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

        // 2. Ambil data produk secara ringan dan paginasi agar halaman tidak memuat semua data sekaligus
        $products = Product::query()
            ->select('id', 'name', 'description', 'price', 'stock', 'image', 'category_id', 'created_at')
            ->with(['category' => function ($query) {
                $query->select('id', 'name');
            }])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->appends($request->only('search'));

        // 3. Kirim data produk ke halaman admin index
        return view('product.admin_index', compact('products'));
    }

    /**
     * FUNGSI PUBLIK: Menampilkan halaman katalog toko untuk pembeli
     * URL: / atau /products
     */
    public function allProducts(Request $request)
    {
        // 1. Ambil semua data kategori untuk tombol filter di katalog pembeli
        $categories = Category::all();

        // 2. Mulai kueri dasar produk beserta relasi kategorinya
        $query = Product::with('category');

        // 3. Cek apakah ada parameter 'category' di URL (Contoh: ?category=1)
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 4. Ambil datanya dan batasi 12 produk per halaman
        $semuaProduk = $query->paginate(12);
        
        // 5. Mengirim data produk DAN kategori ke view katalog 'products.blade.php'
        return view('products', [
            'products' => $semuaProduk,
            'categories' => $categories
        ]);
    }

    // --- TAMBAHAN SESI 8 & 21 ---

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
     * Memproses penyimpanan produk baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input form biar ga kosong (Tambahkan rule untuk stock)
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
            'stock'       => 'required|integer|min:0', // 💡 Wajib diisi angka bulat minimal 0
        ], [
            'name.required'        => 'Nama produk wajib diisi, bro!',
            'price.required'       => 'Harga produk jangan dikosongin.',
            'price.numeric'        => 'Harga harus berupa angka ya!',
            'category_id.required' => 'Pilih kategori produknya dulu.',
            'image.required'       => 'Foto produk wajib di-upload!',
            'image.image'          => 'File yang kamu upload harus berupa gambar.',
            'image.max'            => 'Ukuran foto kegedean, maksimal 2MB aja.',
            'stock.required'       => 'Jumlah stok barang wajib diisi ya!',
            'stock.integer'        => 'Stok harus berupa angka bulat.',
            'stock.min'            => 'Stok minimal adalah 0.',
        ]);

        // 💡 Inisialisasi ditaruh di sini (di luar IF) agar Intelephense VS Code ga ngasih warning kuning
        $imageName = null;

        // 2. Proses upload file gambar ke folder public
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Bikin nama file unik pakai kombinasi timestamp waktu
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Pindahkan file gambar ke folder: public/uploads/products/
            $image->move(public_path('uploads/products'), $imageName);
        }

        // 3. Simpan data ke tabel 'products' lewat Model Product
        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image'       => $imageName ? 'uploads/products/' . $imageName : null,
            'views'       => 0,
            'stock'       => $request->stock // 💡 SEKARANG DITANGKAP DARI INPUT FORM!
        ]);

        // 4. Balikkan ke halaman tabel produk dengan rute utama yang aman
        return redirect()->route('products.index')->with('success', 'Produk baru berhasil ditambah ke katalog!');
    }

    /**
     * Menampilkan halaman formulir edit produk lama berdasarkan ID
     */
    public function edit(string $id) // 💡 Ditambahkan tipe data string agar info notice hilang
    {
        // 1. Cari data produk yang mau diedit, jika tidak ada langsung memunculkan error 404
        $product = Product::findOrFail($id);

        // 2. Ambil semua data kategori untuk pilihan dropdown di form edit
        $categories = Category::all();

        // Mengarahkan ke file view: resources/views/product/edit.blade.php
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * 🛠️ FIX-EROR: Memproses pembaruan data produk lama di database
     */
    public function update(Request $request, string $id)
    {
        // 1. Cari data produk lama berdasarkan ID
        $product = Product::findOrFail($id);

        // 2. Validasi input data dari form edit
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Boleh kosong kalau gamau ganti gambar
            'stock'       => 'required|integer|min:0',
        ], [
            'name.required'        => 'Nama produk wajib diisi, bro!',
            'price.required'       => 'Harga produk jangan dikosongin.',
            'price.numeric'        => 'Harga harus berupa angka ya!',
            'category_id.required' => 'Pilih kategori produknya dulu.',
            'image.image'          => 'File yang kamu upload harus berupa gambar.',
            'image.max'            => 'Ukuran foto kegedean, maksimal 2MB aja.',
            'stock.required'       => 'Jumlah stok barang wajib diisi ya!',
            'stock.integer'        => 'Stok harus berupa angka bulat.',
            'stock.min'            => 'Stok minimal adalah 0.',
        ]);

        // 3. Set gambar default menggunakan gambar lama yang sudah ada di DB
        $imagePath = $product->image;

        // 4. Jika user mengunggah foto baru, proses simpan dan singkirkan foto lama
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Hapus file fisik gambar lama di folder public jika ada
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // Buat nama file baru unik
            $newImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $newImageName);
            
            // Set jalur path baru untuk disimpan ke DB
            $imagePath = 'uploads/products/' . $newImageName;
        }

        // 5. Eksekusi update data produk ke database
        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
            'stock'       => $request->stock
        ]);

        // 6. Kembalikan ke halaman tabel produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * FUNGSI PUBLIK: Menampilkan halaman detail produk
     * URL: /products/{id}
     */
    public function show(string $id) // 💡 Ditambahkan tipe data string agar info notice hilang
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

    /**
     * FUNGSI TAMBAHAN: Menghapus produk
     */
    public function destroy(string $id) // 💡 Ditambahkan tipe data string agar info notice hilang
    {
        $product = Product::findOrFail($id);
        
        // Hapus file fisiknya di folder public jika ada sebelum datanya dihapus dari DB
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}