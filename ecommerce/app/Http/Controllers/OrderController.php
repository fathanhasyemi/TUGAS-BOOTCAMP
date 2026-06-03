<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // fungsi untuk keranjang 
    public function cart()
    {
        return view('cart');
    }

    // fungsi untuk checkout
    public function checkout()
    {
        return 'ini halaman checkout (dari OrderController)';  
    }
}
