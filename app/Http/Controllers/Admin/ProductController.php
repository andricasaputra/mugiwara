<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::when(request()->q, function($products) {
            $products->where('name', 'like', '%'.request()->q.'%');
        })->get();
        return view('admin.product.index', compact('products'));
    }
    public function create()
    {
        return view('admin.product.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'point_needed' => 'required',
        ]);
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'point_needed' => $request->point_needed,
        ]);
        return redirect()->route('admin.product.index')->with('success', 'Data produk berhasil ditambahkan');
    }
    
    public function edit($productId)
    {
        $product = Product::find($productId);
        return view('admin.product.edit', compact('product'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'point_needed' => 'required',
        ]);
        $product = Product::find($request->id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'point_needed' => $request->point_needed,
        ]);
        return redirect()->route('admin.product.index')->with('success', 'Data produk berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Data produk berhasil dihapus');
    }
}
