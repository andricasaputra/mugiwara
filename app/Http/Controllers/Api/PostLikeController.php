<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function index()
    {
        $likes = PostLike::with(['post', 'user:id,name', 'user.account'])->latest()->paginate(10);

        return response()->json($likes);
    }

    public function store(Request $request, Post $post)
    {
        try {

            $post_like = PostLike::where('post_id', $post->id)->first();

            if($post_like?->user_id == request()->user()->id){
                return response()->json([
                    'message' => 'you have already like this blog'
                ]);
            }

            PostLike::create([
                'post_id' => $post->id,
                'user_id' => request()->user()->id,
                'like_count' => $post_like?->like_count ?? 0 + 1
            ]);

            return response()->json([
                'data' => [
                    'post' => $post,
                    'likes' => $post->likes()?->sum('like_count'),
                ],
                'message' => 'like added successfully'
            ]);
            
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'failed to add like, error : ' . $e->getMessage()
            ], 500);
            
        }
    }

    public function destroy(PostLike $like)
    {
        $like->delete();

        return response()->json([
            'succes delete a like'
        ]);
    }
}
