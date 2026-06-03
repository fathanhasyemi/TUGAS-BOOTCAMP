<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Kita panggil DB Facade di sini

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kita buat seeder untuk tabel categories
        DB::table('categories')->insert([
            ['name' => 'Fashion'],
            ['name' => 'Elektronik'],
        ]);
        

        //2.mengisi data contoh ke tabel products
        DB::table('products')->insert([
            [
                'name' => 'Sepatu Sneakers Keren',
                'description' => 'Sepatu sneakers berkualitas tinggi, nyaman dipakai sehari-hari.',
                'stock' => 10,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'kemeja flanel stylish',
                'description' => 'Kaos polos dengan bahan berkualitas, cocok untuk berbagai gaya.',
                'stock' => 20,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Smartphone Canggih',
                'description' => 'Smartphone dengan fitur terbaru, cocok untuk kebutuhan sehari-hari.',
                'stock' => 5,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Laptop Gaming',
                'description' => 'Laptop dengan performa tinggi untuk gaming dan pekerjaan berat.',
                'stock' => 3,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Tas Ransel Stylish',
                'description' => 'Tas ransel dengan desain modern, cocok untuk aktivitas sehari-hari.',
                'stock' => 8,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],      

            [
                'name' => 'Jam Tangan Elegan',
                'description' => 'Jam tangan dengan desain elegan, cocok untuk berbagai kesempatan.',
                'stock' => 12,
                'image' => 'gambar-1.jpg', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Kamera Digital',
                'description' => 'Kamera dengan resolusi tinggi, cocok untuk fotografi dan videografi.',
                'stock' => 4,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Speaker Bluetooth',
                'description' => 'Speaker nirkabel dengan suara yang kuat dan jernih.',
                'stock' => 10,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Kipas Angin Portable',
                'description' => 'Kipas angin kecil yang mudah dibawa, cocok untuk penggunaan di dalam ruangan.',
                'stock' => 25,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Power Bank 10000mAh',
                'description' => 'Power bank dengan kapasitas besar untuk mengisi daya perangkat Anda di mana saja.',
                'stock' => 30,
                'image' => 'gambar-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
        ]);
    }
}
