<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Cart\Payments\Gateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethods\PaymentMethodSotreRequest;
use App\Http\Resources\PaymentMethods\PaymentMethodResource;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    public function __construct(Gateway $gateway)
    {
    	$this->middleware(['auth:api']);

        $this->gateway = $gateway;
    }

    public function index(Request $request)
    {
    	return PaymentMethodResource::collection(
    		$request->user()->paymentMethods
    	);
    }

    public function store(PaymentMethodSotreRequest $request)
    {
        $card = $this->gateway->withUser($request->user())
            ->createCustomer()
            ->addCard($request->token);

            return new PaymentMethodResource($card);
    }
}
