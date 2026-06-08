<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Tambahkan baris ini di sini agar kolom database diizinkan menerima data baru
    protected $fillable = ['name', 'stock', 'description', 'image', 'category_id'];

    public function category()
    {
        // Hubungan relasi lama kamu tetap aman di sini
        return $this->belongsTo(Category::class, 'category_id');
    }

        /**
     * Accessor untuk mengubah nama produk diawali huruf kapital.
     */
    protected function name(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn (string $value) => ucwords(strtolower($value)),
        );
    }
}