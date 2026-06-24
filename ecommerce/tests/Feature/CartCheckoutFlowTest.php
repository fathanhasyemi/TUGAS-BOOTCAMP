<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CartCheckoutFlowTest extends TestCase
{
    public function test_checkout_page_displays_items_from_database_cart(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Olahraga']);
        $product = Product::factory()->create([
            'name' => 'Sepatu Running',
            'price' => 25000,
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($user)->get('/checkout');

        $response->assertOk();
        $response->assertSee('Sepatu Running');
        $response->assertSee('Rp50.000');
    }

    public function test_checkout_can_create_orders_for_multiple_products(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Olahraga']);

        $productOne = Product::factory()->create([
            'name' => 'Sepatu Running',
            'price' => 25000,
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        $productTwo = Product::factory()->create([
            'name' => 'Kaos Premium',
            'price' => 120000,
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        Cart::create(['user_id' => $user->id, 'product_id' => $productOne->id, 'quantity' => 1]);
        Cart::create(['user_id' => $user->id, 'product_id' => $productTwo->id, 'quantity' => 2]);

        $response = $this->actingAs($user)->post('/checkout', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'address' => 'Jl. Test',
            'phone' => '08123456789',
        ]);

        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseCount('orders', 2);
    }
}
