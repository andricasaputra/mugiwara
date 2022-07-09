<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function index()
    {
        $categoryPosts = CategoryPost::when(request()->q, function($categoryPosts) {
            $categoryPosts->where('name', 'like', '%'.request()->q.'%');
        })->get();
        return view('admin.category_post.index', compact('categoryPosts'));
    }
    public function create()
    {
        return view('admin.category_post.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        CategoryPost::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.category_post.index')->with('success', 'Data kategori artikel berhasil ditambahkan');
    }
    
    public function edit($productId)
    {
        $categoryPost = CategoryPost::find($productId);
        return view('admin.category_post.edit', compact('categoryPost'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $product = CategoryPost::find($request->id);
        $product->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.category_post.index')->with('success', 'Data kategori artikel berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $product = CategoryPost::find($request->id);
        $product->delete();
        return redirect()->route('admin.category_post.index')->with('success', 'Data kategori artikel berhasil dihapus');
    }
}
