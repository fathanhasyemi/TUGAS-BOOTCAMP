<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang diizinkan untuk pengisian massal (Mass Assignment).
     * Pastikan 'price' masuk di sini agar harga produk bisa disimpan.
     */
    protected $fillable = [
        'name', 
        'category_id', 
        'price', 
        'stock', 
        'description', 
        'image'
    ];

    /**
     * Relasi ke model Category (Satu produk termasuk dalam satu kategori).
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Accessor untuk mengubah nama produk diawali huruf kapital di setiap kata.
     * Contoh: "sepatu running nike" -> "Sepatu Running Nike"
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords(strtolower($value)),
        );
    }
}