<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Halaman Utama Keranjang Belanja
    public function index()
    {
        return view('cart');
    }

    // Proses Tambah Produk ke Keranjang (Session)
    public function addToCart($id)
    {
        // Cari data produk di database berdasarkan ID
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        // Ambil data keranjang saat ini dari Session internet
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambahkan jumlah kuantitasnya saja (+1)
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika belum ada, masukkan data produk baru ke dalam array keranjang
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // Simpan data array terbaru ke dalam session
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil masuk keranjang!');
    }

    // Proses Hapus Produk dari Keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}