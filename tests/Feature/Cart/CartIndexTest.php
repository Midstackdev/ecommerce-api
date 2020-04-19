<?php

namespace Tests\Feature\Cart;

use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartIndexTest extends TestCase
{
    public function test_it_fails_if_unauthenticated()
    {
        $this->json('GET', 'api/cart')

        ->assertStatus(401);
    }

    public function test_it_shows_a_product_in_the_user_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $prodcut = factory(ProductVariation::class)->create()
        );

        $response = $this->jsonAs($user, 'GET', 'api/cart')

            ->assertJsonFragment([
                'id' => $prodcut->id
            ]);
    }
}
