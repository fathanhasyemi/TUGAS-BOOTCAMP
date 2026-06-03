<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        // belongsTo digunakan untuk relasi many to one, dimana banyak produk bisa memiliki satu kategori
        return $this->belongsTo(Category::class, 'category_id');
    }
}
