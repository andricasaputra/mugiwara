<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index()
    {
        $comments = PostComment::with(['post', 'user:id,name', 'user.account'])->latest()->paginate(10);

        return response()->json($comments);
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        try {

            PostComment::create([
                'post_id' => $post->id,
                'user_id' => request()->user()->id,
                'comment' => $request->comment
            ]);

            return response()->json([
                'data' => [
                    'post' => $post,
                    'comment' => $request->comment,
                ],
                'message' => 'comment added successfully'
            ]);
            
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'failed to add comment, error : ' . $e->getMessage()
            ], 500);
            
        }
    }

    public function update(Request $request, Post $post, PostComment $comment)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        try {

            $comment->update([
                'post_id' => $post->id,
                'user_id' => request()->user()->id,
                'comment' => $request->comment
            ]);

            return response()->json([
                'data' => [
                    'post' => $post,
                    'comment' => $request->comment,
                ],
                'message' => 'comment updated successfully'
            ]);
            
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'failed to update comment, error : ' . $e->getMessage()
            ], 500);
            
        }
    }

    public function destroy(PostComment $comment)
    {
        $comment->delete();

        return response()->json([
            'succes delete a comment'
        ]);
    }
}