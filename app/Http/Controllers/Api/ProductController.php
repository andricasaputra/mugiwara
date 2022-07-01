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
        $posts = Product::paginate(10);
        $posts = ResourcesProduct::collection($posts);
        return response()->json([
            'status' => 'success',
            'message' => 'List Products',
            'data' =>  $posts->response()->getData(true),
        ], 200);
    }
}
