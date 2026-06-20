<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    public function test_non_admin_users_cannot_access_dashboard_pages(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->actingAs($user);

        $this->get('/dashboard')->assertStatus(403);
        $this->get('/dashboard/products')->assertStatus(403);
        $this->get('/dashboard/product-categories')->assertStatus(403);
    }
}
