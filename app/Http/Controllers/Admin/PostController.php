<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::when(request()->q, function($posts) {
            $posts->where('title', 'like', '%'.request()->q.'%')->orWhere('body', 'like', '%'.request()->q.'%');
        })->paginate(10);
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        return view('admin.post.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
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
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->slug),
            'image' => $namaImage,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('admin.post.index')->with('success', 'Data berita berhasil ditambahkan');
    }
    
    public function edit($postId)
    {
        $post = Post::find($postId);
        return view('admin.post.edit', compact('post'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
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
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->slug),
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
