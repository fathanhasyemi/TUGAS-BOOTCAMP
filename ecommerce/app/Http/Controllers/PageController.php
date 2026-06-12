<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan baris ini jika belum ada

class PageController extends Controller
{
    public function index()
    {
        // Kirim data produk ke file view home.blade.php
        return view('home');
    }
}