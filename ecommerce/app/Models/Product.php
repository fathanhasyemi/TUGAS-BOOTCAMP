<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Tambahkan baris ini

class Product extends Model
{
    use HasFactory; // 2. Tambahkan baris ini

    public function category()
    {
        // Hubungan relasi lama kamu tetap aman di sini
        return $this->belongsTo(Category::class, 'category_id');
    }
}