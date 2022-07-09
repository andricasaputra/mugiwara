<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryPost as ResourcesCategoryPost;
use App\Http\Resources\Post as ResourcesPost;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function index()
    {
        $categoryPosts = CategoryPost::get();
        return ResourcesCategoryPost::collection($categoryPosts) 
                ->additional([
                    'status' => 'success',
                    'message' => 'List Kategori Artikel',
                ]);
    }
    public function show($id)
    {
        $categoryPost = CategoryPost::findOrFail($id);
        $categoryPost = new ResourcesCategoryPost($categoryPost);
        return $categoryPost
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Kategori Artikel',
                ]);
    }
}
