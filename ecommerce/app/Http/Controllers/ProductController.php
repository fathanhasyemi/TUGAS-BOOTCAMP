<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Panggil DB Facade

class ProductController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data dari tabel produk di database
        $products = DB::table('produk')->get();

        // 2. Kirim variabel $products ke file blade kamu
        return view('home', compact('products')); 
    }
}