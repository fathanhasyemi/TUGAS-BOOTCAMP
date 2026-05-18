<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return ('ini halaman products');
});

Route::get('/users', function() {
    return 'ini halaman users.';
});

