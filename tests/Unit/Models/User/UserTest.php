<?php

namespace Tests\Unit\Models\User;

use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    
    public function test_hashes_the_password_when_creating()
    {
    	$user = factory(User::class)->create([
    		'password' => 'cats'
    	]);

        $this->assertNotEquals($user->password, 'cats');
    }

    public function test_it_has_many_cart_products()
    {
    	$user = factory(User::class)->create();

    	$user->cart()->attach(
    		factory(ProductVariation::class)->create()
    	);

        $this->assertInstanceOf(ProductVariation::class, $user->cart->first());
    }

    public function test_it_has_a_quantity_for_each_cart_products()
    {
    	$user = factory(User::class)->create();

    	$user->cart()->attach(
    		factory(ProductVariation::class)->create(), [
    			'quantity' => $quantity = 5
    		]
    	);

        $this->assertEquals($user->cart->first()->pivot->quantity, $quantity);
    }
}
