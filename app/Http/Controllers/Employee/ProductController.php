<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
         $products = Product::with('image')->when(request()->q, function($products) {
            $products->where('name', 'like', '%'.request()->q.'%');
        })->get();

        return view('employee.product.index', compact('products'));
    }

    public function redeemList()
    {
        $products = ProductUser::latest()->with(['product', 'user'])->get();
        
        return view('admin.product.redeem_list.index', compact('products'));
    }
}
