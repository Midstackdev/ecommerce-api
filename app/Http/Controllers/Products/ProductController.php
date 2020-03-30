<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductIndexResource;
use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use App\Scoping\Scopes\CategoryScope;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::withScopes($this->scopes())->paginate(10);

    	return ProductIndexResource::collection($products);
    }

    public function show(Product $product)
    {

    	return new ProductResource(
    		$product
    	);
    }

    protected function scopes()
    {
    	return [
    		'category' => new CategoryScope()
    	];
    }
}
