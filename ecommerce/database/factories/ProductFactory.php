<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // membuat nama produk dengan faker yang terdiri dari 3 kata
            'name' => $this->faker->words(3, true),

            // membuat deskripsi teks paragraf palsu
            'description' => $this->faker->paragraph(),

            // membuat harga acak antara 50.000 dan 500.000
            'price' => $this->faker->numberBetween(50000, 500000    ),

            // mengaitkan produk dengan kategori 1 atau 2 secara acak
            'category_id' => $this->faker->randomElement([1, 2]),

            // membuat stok acak antara 5 dan 50
            'stock' => $this->faker->numberBetween(5, 50),

            // nambah gambar-1 untuk produk
            'image' => 'gambar-1.jpg',

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
