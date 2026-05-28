<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan baris ini jika belum ada

class PageController extends Controller
{
    public function index()
    {
        // Ambil data produk dari database
        $products = DB::table('produk')->get();

        // Kirim data produk ke file view home.blade.php
        return view('home', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }
}