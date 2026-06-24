<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Relasi: Cart ini milik seorang User
    public function user()
    {
        // ✅ SUDAH DIPERBAIKI: Menggunakan $this
        return $this->belongsTo(User::class);
    }

    // Relasi: Cart ini isinya adalah sebuah Produk
    public function product()
    {
        // ✅ SUDAH DIPERBAIKI: Menggunakan $this
        return $this->belongsTo(Product::class);
    }
}