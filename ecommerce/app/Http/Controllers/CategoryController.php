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

    /**
     * Menampilkan form tambah kategori
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menampilkan halaman formulir edit kategori lama berdasarkan ID
     */
    public function edit(string $id) // 💡 Ditambahkan tipe data string agar notice hilang
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Memproses penyimpanan kategori baru ke database (Sesi 21 - Menghidupkan Form)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Keamanan
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi, bro!',
            'name.unique' => 'Nama kategori ini sudah terdaftar di toko.',
        ]);

        // 2. Simpan ke database via Model Category
        Category::create([
            'name' => $request->name
        ]);

        // 3. Redirect kembali ke halaman tabel dengan rute utama yang aman
        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Memproses pembaruan data kategori lama di database
     */
    public function update(Request $request, string $id) // 💡 Ditambahkan tipe data string agar notice hilang
    {
        // 1. Ambil data kategori lama berdasarkan ID
        $category = Category::findOrFail($id);

        // 2. Validasi Input (Kecualikan validasi unik untuk ID kategori ini sendiri)
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama kategori tidak boleh dikosongkan, bro!',
            'name.unique' => 'Nama kategori ini sudah dipakai.',
        ]);

        // 3. Update data lama dengan data baru
        $category->update([
            'name' => $request->name
        ]);

        // 4. Redirect kembali ke halaman tabel dengan rute utama yang aman
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * 🛠️ FIX-EROR: Memproses penghapusan data kategori dari database
     */
    public function destroy(string $id)
    {
        // 1. Cari data kategori berdasarkan ID, kalau ga ada langsung lempar error 404
        $category = Category::findOrFail($id);

        // 2. Cek apakah ada produk yang masih nempel pakai kategori ini
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Kategori gagal dihapus karena masih digunakan oleh produk aktif!');
        }

        // 3. Hapus kategori dari database jika aman
        $category->delete();

        // 4. Kembalikan ke halaman utama kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori sukses dihapus dari database!');
    }
}