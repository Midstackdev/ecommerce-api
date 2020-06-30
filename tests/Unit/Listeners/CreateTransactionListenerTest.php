<?php

namespace Tests\Unit\Listeners;

use App\Cart\Cart;
use App\Events\Order\OrderPaid;
use App\Listeners\Order\CreateTransaction;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class CreateTransactionListenerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_creates_a_transaction()
    {
    	$event = new OrderPaid(
    		$order = factory(Order::class)->create([
    			'user_id' => factory(User::class)->create()->id
    		])
    	);

    	$listener = new CreateTransaction();

    	$listener->handle($event);

    	$this->assertdatabaseHas('transactions', [
            'order_id' => $event->order->id
        ]);
    }
}
