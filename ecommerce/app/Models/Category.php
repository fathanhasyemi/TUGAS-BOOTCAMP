<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        // hasmany digunakan untuk relasi one to many, dimana satu kategori bisa memiliki banyak produk
        return $this->hasMany(Product::class, 'category_id');
    }
}
