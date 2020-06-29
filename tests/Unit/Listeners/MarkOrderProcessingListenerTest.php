<?php

namespace Tests\Unit\Listeners;

use App\Cart\Cart;
use App\Events\Order\OrderPaid;
use App\Listeners\Order\EmptyCart;
use App\Listeners\Order\MarkOrderProcessing;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class MarkOrderProcessingListenerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_marks_order_as_processing()
    {
    	$event = new OrderPaid(
    		$order = factory(Order::class)->create([
    			'user_id' => factory(User::class)->create()->id
    		])
    	);

    	$listener = new MarkOrderProcessing();

    	$listener->handle($event);

    	$this->assertEquals($order->fresh()->status, Order::PROCESSING);
    }
}
