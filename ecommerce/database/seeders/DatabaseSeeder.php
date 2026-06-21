<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product; // PENTING: Jangan lupa panggil model Product di sini

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. MEMBUAT AKUN ADMIN UTAMA (Biar gak eror 403 pas login)
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('asmsmahmaa'), // Password lo buat login
            'is_admin' => true, // Mengaktifkan status admin sesuai blueprint tabel user lo
        ]);

        // 2. Kita buat seeder untuk tabel categories
        DB::table('categories')->insert([
            ['name' => 'Fashion'],     // ID: 1
            ['name' => 'Elektronik'],   // ID: 2
        ]);
        
        // 3. SEKALIGUS JALANKAN FACTORY: Membuat 50 produk dummy otomatis tambahan
        Product::factory(50)->create();
    }
}