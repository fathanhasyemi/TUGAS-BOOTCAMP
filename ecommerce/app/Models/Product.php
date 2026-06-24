<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str; // 💡 TAMBAHKAN INI untuk fungsi Str::slug

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang diizinkan untuk pengisian massal (Mass Assignment).
     * Pastikan 'price' masuk di sini agar harga produk bisa disimpan.
     */
    protected $fillable = [
        'name', 
        'slug', // 💡 TAMBAHKAN INI agar slug bisa disimpan ke database
        'category_id', 
        'price', 
        'stock', 
        'description', 
        'image',
        'views'
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

    /**
     * 💡 FITUR OTOMATIS: Membuat slug otomatis dari nama produk sebelum disimpan
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            // Jika kolom slug masih kosong atau nama produk sedang diubah, otomatis buat/perbarui slug-nya
            if (empty($product->slug) || $product->isDirty('name')) {
                // Kita gunakan raw value dari attribute name agar tidak bentrok dengan Accessor ucwords di atas
                $nameForSlug = $product->getAttributes()['name'] ?? $product->name;
                $product->slug = Str::slug($nameForSlug);
            }
        });
    }
}