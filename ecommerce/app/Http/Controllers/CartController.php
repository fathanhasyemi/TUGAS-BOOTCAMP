<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart; // 💡 Pastikan model Cart di-import di sini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Halaman Utama Keranjang Belanja (Membaca dari Database)
    public function index()
    {
        // Ambil semua data cart milik user yang sedang login beserta relasi produknya
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Oper data ke view 'cart'
        return view('cart', compact('cartItems'));
    }

    // 2. Proses Tambah Produk ke Keranjang (Menyimpan ke Database)
    public function addToCart(Request $request, $id)
    {
        // Pastikan user sudah login sebelum memanipulasi database
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $userId = Auth::id();

        // Cek apakah produk ini sudah ada di dalam database cart milik user tersebut
        $existingCart = Cart::where('user_id', $userId)
                            ->where('product_id', $id)
                            ->first();

        if ($existingCart) {
            $newQuantity = $existingCart->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Jumlah yang dimasukkan melebihi stok yang tersedia.');
            }

            // Update kuantitas di database
            $existingCart->update(['quantity' => $newQuantity]);
        } else {
            // Buat baris baru di tabel carts database
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $id,
                'quantity'   => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil masuk keranjang database!');
    }

    // 3. Proses Tambah/Kurang Kuantitas (Update Data di Database)
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $id)
                        ->first();
                        
        $product = Product::find($id);

        if ($cartItem && $product) {
            $action = $request->input('action');
            
            if ($action === 'increase') {
                $newQuantity = $cartItem->quantity + 1;
                
                if ($newQuantity > $product->stock) {
                    return redirect()->back()->with('error', 'Stok tidak mencukupi untuk menambah barang.');
                }
                
                $cartItem->update(['quantity' => $newQuantity]);
                
            } elseif ($action === 'decrease') {
                $newQuantity = $cartItem->quantity - 1;
                
                if ($newQuantity < 1) {
                    // Jika kuantitas di bawah 1, hapus dari database
                    $cartItem->delete();
                } else {
                    $cartItem->update(['quantity' => $newQuantity]);
                }
            }
        }

        return redirect()->back()->with('with', 'Keranjang database berhasil diperbarui!');
    }

    // 4. Proses Hapus Produk dari Keranjang (Hapus Baris dari Database)
    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $id)
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang database!');
    }
}