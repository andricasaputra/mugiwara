<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as ResourcesPost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        $posts = ResourcesPost::collection($posts);
        return response()->json([
            'status' => 'success',
            'message' => 'List Posts',
            'data' =>  $posts->response()->getData(true),
        ], 200);
    }
}
