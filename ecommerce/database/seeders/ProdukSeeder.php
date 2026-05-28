<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'name' => 'Smartphone Gacor X',
                'description' => 'HP spesifikasi tinggi ramah di kantong.',
                'stock' => 50,
                'harga' => 250000,
                'image' => 'smartphone.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'kaos Polo hitam',
                'description' => 'baju spesifikasi tinggi ramah di kantong.',
                'stock' => 40,
                'harga' => 250000,
                'image' => 'kaos-hitam.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Susu protein',
                'description' => 'gainer mass spesifikasi tinggi ramah di kantong.',
                'stock' => 60,
                'harga' => 250000,
                'image' => 'fitlife.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
