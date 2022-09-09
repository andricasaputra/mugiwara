<?php

namespace App\Http\Controllers\Employee;

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

        return view('employee.category_post.index', compact('categoryPosts'));
    }

    public function create()
    {
        return view('employee.category_post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        CategoryPost::create([
            'name' => $request->name,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('employee.category_post.index')->with('success', 'Data kategori artikel berhasil ditambahkan');
    }

    public function edit($productId)
    {
        $categoryPost = CategoryPost::find($productId);

        if($categoryPost->user_id != auth()->id()) abort('403');

        return view('employee.category_post.edit', compact('categoryPost'));
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

        return redirect()->route('employee.category_post.index')->with('success', 'Data kategori artikel berhasil diubah');
    }

    public function delete(Request $request)
    {
        $product = CategoryPost::find($request->id);

        $product->delete();

        return redirect()->route('employee.category_post.index')->with('success', 'Data kategori artikel berhasil dihapus');
    }
}
