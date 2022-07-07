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
        return ResourcesPost::collection($posts) 
                ->additional([
                    'status' => 'success',
                    'message' => 'List Posts',
                ]);
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post = new ResourcesPost($post);
        return $post
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Post',
                ]);
    }
}
