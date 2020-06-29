<?php

namespace Tests\Unit\Listeners;

use App\Cart\Cart;
use App\Listeners\Order\EmptyCart;
use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class EmptyCartListenerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_should_clear_the_cart()
    {
       $cart = new Cart(
       		$user = factory(User::class)->create()
       );

       $user->cart()->attach(
       		$product = factory(ProductVariation::class)->create()
       );

       $listener = new EmptyCart($cart);

       $listener->handle();

       $this->assertEmpty($user->cart);
    }
}
