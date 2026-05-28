<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['id' => 1, 'name' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Pakaian Pria', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Sepatu Olahraga', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
