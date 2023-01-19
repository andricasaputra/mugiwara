<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostVisit;
use Illuminate\Http\Request;

class PostVisitController extends Controller
{
    public function index()
    {
        $visitors = PostVisit::with(['post', 'user:id,name', 'user.account'])->latest()->paginate(10);

        return response()->json($visitors);
    }

    public function store(Request $request, Post $post)
    {
        try {

            $post_visitors = PostVisit::where('post_id', $post->id)->first();

            PostVisit::create([
                'post_id' => $post->id,
                'user_id' => request()->user()->id,
                'visitor_count' => $post_visitors?->visitor_count ?? 0 + 1
            ]);

            return response()->json([
                'data' => [
                    'post' => $post,
                    'visitors' => $post->visitors()?->sum('visitor_count'),
                ],
                'message' => 'visitor added successfully'
            ]);
            
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'failed to add visitor, error : ' . $e->getMessage()
            ], 500);
            
        }
    }

    public function destroy(PostVisit $visitor)
    {
        $visitor->delete();

        return response()->json([
            'succes delete a visitor'
        ]);
    }
}
