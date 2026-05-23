<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('home'); // <-- Memanggil halaman home
    }

    public function cart()
    {
        return view('cart'); // <-- Memanggil halaman keranjang
    }
}