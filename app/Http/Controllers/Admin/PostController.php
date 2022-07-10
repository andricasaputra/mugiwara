<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->when(request()->q, function($posts) {
            $posts->where('title', 'like', '%'.request()->q.'%')->orWhere('body', 'like', '%'.request()->q.'%');
        })->get();
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        $categoryPosts = CategoryPost::all();
        return view('admin.post.create', compact('categoryPosts'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_post_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'is_active' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);
        if($request->image){
            $img = $request->file('image');
            $size = $img->getSize();
            $namaImage = time() . "_" . $img->getClientOriginalName();
            Storage::disk('public')->put('data/'.$namaImage, file_get_contents($img->getRealPath()));
        }
        Post::create([
            'user_id' => auth()->user()->id,
            'category_post_id' => $request->category_post_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
            'image' => $namaImage,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('admin.post.index')->with('success', 'Data berita berhasil ditambahkan');
    }
    
    public function show($postId)
    {
        $post = Post::find($postId);
        return view('admin.post.show', compact('post'));
    }
    public function edit($postId)
    {
        $post = Post::find($postId);
        $categoryPosts = CategoryPost::all();
        return view('admin.post.edit', compact('post','categoryPosts'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'category_post_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'is_active' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,jpg',
        ]);
        $post = Post::find($request->id);
        if($request->image){
            Storage::disk('public')->delete('data/'.$post->image);
            $img = $request->file('image');
            $size = $img->getSize();
            $namaImage = time() . "_" . $img->getClientOriginalName();
            Storage::disk('public')->put('data/'.$namaImage, file_get_contents($img->getRealPath()));
        }
        $post->update([
            'user_id' => auth()->user()->id,
            'category_post_id' => $request->category_post_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
            'image' => $namaImage ?? $post->image,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('admin.post.index')->with('success', 'Data berita berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        Storage::disk('public')->delete('data/'.$post->image);
        $post->delete();
        return redirect()->route('admin.post.index')->with('success', 'Data berita berhasil dihapus');
    }
}
