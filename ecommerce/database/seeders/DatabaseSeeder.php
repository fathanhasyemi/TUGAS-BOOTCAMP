<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product; // PENTING: Jangan lupa panggil model Product di sini

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kita buat seeder untuk tabel categories
        DB::table('categories')->insert([
            ['name' => 'Fashion'],     // ID: 1
            ['name' => 'Elektronik'],   // ID: 2
        ]);
        
        // 2. SEKALIGUS JALANKAN FACTORY: Membuat 20 produk dummy otomatis tambahan
        Product::factory(50)->create();
    }
}