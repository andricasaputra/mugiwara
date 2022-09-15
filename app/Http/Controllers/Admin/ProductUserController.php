<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductUser;
use App\Uploads\PhotoDeliveryUploadService;
use App\Uploads\PhotoPickupUploadService;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    public function redeemList()
    {
        $products = ProductUser::latest()->with(['product', 'user'])->get();

        return view('admin.product.redeem_list.index', compact('products'));
    }


    public function redeemTypeList($redeem_type)
    {
        $redeem = ProductUser::with('image')->where('redeem_type', $redeem_type)->firstOrFail();
        
        return view('admin.product.redeem_list.create_redeem_list_type', compact('redeem'));
    }

    public function edit($redeem_type)
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

    public function detail($product)
    {
        $redeem = ProductUser::findOrFail($product);
        
        return view('admin.product.redeem_list.detail')->withProduct($redeem->load(['user', 'product.image', 'image']));
    }

    public function update(Request $request)
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

        return redirect()->route('admin.product.redeem.list')->with('success', 'Berhasil Perbarui Data');
    }

    public function delete(Request $request)
    {
        $product_user  = ProductUser::findOrFail($request->id);

        $product_user->delete();

          return redirect()->route('admin.product.redeem.list')->with('success', 'Berhasil Hapus Data');
    }
}
