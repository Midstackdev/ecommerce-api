<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use App\Models\Order;
use App\Models\ShippingMethod;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'address_id' => factory(Address::class)->create()->id,
        'shipping_method_id' => factory(ShippingMethod::class)->create()->id,
        'subtotal' => 1000
    ];
});
