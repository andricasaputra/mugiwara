<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Product as ResourcesProduct;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        $products->appends(request()->all());
        return ResourcesProduct::collection($products)
                ->additional([
            'status' => 'success',
            'message' => 'List Products'
        ]);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product = new ResourcesProduct($product);
        return $product
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Product',
                ]);
    }
}
