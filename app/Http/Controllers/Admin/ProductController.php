<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductUser;
use App\Uploads\PhotoDeliveryUploadService;
use App\Uploads\PhotoPickupUploadService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['image'])->when(request()->q, function($products) {
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
            'photo_product' => 'required|mimes:png,jpg,jpeg'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'point_needed' => $request->point_needed,
        ]);

        if($request->hasFile('photo_product')){

            $file = $request->file('photo_product');

            $factory  = app()->make(UploadServiceInterface::class);

            $fileName = $factory->process($file);

            $product->image()->create([
                'image' => $fileName
            ]);
        }

        return redirect()->route('admin.product.index')->with('success', 'Data produk berhasil ditambahkan');
    }
    
    public function edit($productId)
    {
        $product = Product::find($productId)->load('image');
        return view('admin.product.edit', compact('product'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'point_needed' => 'required',
            'photo_product' => 'sometimes|mimes:png,jpg,jpeg'
        ]);
        $product = Product::find($request->id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'point_needed' => $request->point_needed,
        ]);

        if($request->hasFile('photo_product')){

            $file = $request->file('photo_product');

            $factory  = app()->make(UploadServiceInterface::class);

            $fileName = $factory->process($file);

            $product->image()->update([
                'image' => $fileName
            ]);
        }
        
        return redirect()->route('admin.product.index')->with('success', 'Data produk berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Data produk berhasil dihapus');
    }

    public function redeemList()
    {
        $products = ProductUser::latest()->with(['product', 'user'])->get();
        
        return view('admin.product.redeem_list.index', compact('products'));
    }


    public function redeemTypeList($redeem_type)
    {
        $redeem = ProductUser::with('image')->where('redeem_type', $redeem_type)->first();
        
        return view('admin.product.redeem_list.create_redeem_list_type', compact('redeem'));
    }

    public function uploadPage($redeem_type)
    {
        if($redeem_type == 'pickup'){
            $redeem = ProductUser::where('redeem_type', $redeem_type)->first();
            dd($request->all());
            return view('admin.product.redeem_list.uploads.pickup', compact('redeem'));
        }else{
            $redeem = ProductUser::where('redeem_type', $redeem_type)->first();
            return view('admin.product.redeem_list.uploads.devlivery', compact('redeem'));
        }
    }

    public function upload(Request $request)
    {
        $redeem = ProductUser::where('redeem_type', $request->redeem_type)->first();

        if($request->hasFile('photo_pickup')){
            $upload = new PhotoPickupUploadService;
            $filename = $upload->process($request->file('photo_pickup'));
        }else{
            $upload = new PhotoDeliveryUploadService;
           $filename = $upload->process($request->file('photo_delivery'));
        }

        $redeem->image()->create([
            'image' => $filename
        ]);

        return redirect()->route('admin.product.redeem.list')->with('success', 'Berhasil Uppload Bukti');
    }

}
