<?php


	Route::resource('categories', 'Category\CategoryController');
	Route::resource('products', 'Products\ProductController');

	Route::post('auth/signup', 'Auth\SignUpController@action');
	Route::post('auth/signin', 'Auth\SignInController@action');
	Route::get('auth/me', 'Auth\MeController@action');

