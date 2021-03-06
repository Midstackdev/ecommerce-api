<?php


	Route::resource('categories', 'Category\CategoryController');
	Route::resource('products', 'Products\ProductController');
	Route::resource('addresses', 'Addresses\AddressController');
	Route::resource('countries', 'Countries\CountryController');
	Route::resource('orders', 'Orders\OrderController');
	Route::resource('payment-methods', 'PaymentMethods\PaymentMethodController');

	Route::get('addresses/{address}/shipping', 'Addresses\AddressShippingController@action');

	Route::post('auth/signup', 'Auth\SignUpController@action');
	Route::post('auth/signin', 'Auth\SignInController@action');
	Route::get('auth/me', 'Auth\MeController@action');

	Route::resource('cart', 'Cart\CartController', [
		'parameters' => [
			'cart' => 'productVariation'
		]
	]);
