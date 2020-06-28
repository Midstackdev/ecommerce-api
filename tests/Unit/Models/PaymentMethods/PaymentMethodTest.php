<?php

namespace Tests\Unit\Models\PaymentMethods;

use App\Models\PaymentMethod;
use App\Models\User;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    public function test_it_belongs_to_a_user()
    {
    	$address = factory(PaymentMethod::class)->create([
    		'user_id' => factory(User::class)->create()->id
    	]);

        $this->assertInstanceOf(User::class, $address->user);
    }

    public function test_it_sets_old_payment_method_to_not_default_when_creating()
    {

    	$user = factory(User::class)->create();

    	$oldPaymentMethod = factory(PaymentMethod::class)->create([
    		'default' => true,
    		'user_id' => $user->id
    	]);


    	factory(PaymentMethod::class)->create([
    		'default' => true,
    		'user_id' => $user->id
    	]);

        $this->assertFalse((boolean)$oldPaymentMethod->fresh()->default);
    }
}
