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
        $posts = Post::when(request()->category_post_id, function($posts) {
            $posts->where('category_post_id', request()->category_post_id);
        })
        ->where('is_active', '1')
        ->paginate(10);
        $posts->appends(request()->all());
        return ResourcesPost::collection($posts) 
                ->additional([
                    'status' => 'success',
                    'message' => 'List Artikel',
                ]);
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post = new ResourcesPost($post);
        return $post
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Artikel',
                ]);
    }
}
