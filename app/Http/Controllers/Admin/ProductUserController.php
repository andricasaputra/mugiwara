<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductUser;
use App\Uploads\PhotoDeliveryUploadService;
use App\Uploads\PhotoPickupUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

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

    public function edit($id)
    {
        $redeem = ProductUser::find($id);
        $p = Product::find($redeem->product_id);

        return view('admin.product.redeem_list.edit', compact('redeem', 'p'));
    }

    public function detail($product)
    {
        $redeem = ProductUser::findOrFail($product);
        
        return view('admin.product.redeem_list.detail')->withProduct($redeem->load(['user', 'product.image', 'image']));
    }

    public function update(Request $request, $id)
    { 
        try {

            DB::beginTransaction();

            $redeem = ProductUser::find($id);

            if($request->redeem_type == 'pickup'){

                if($request->photo_pickup && $request->hasFile('photo_pickup')){

                    if(! is_null($redeem->image)){
                        $this->deleteOldImage($redeem, 'pickups');
                    }

                    $upload = new PhotoPickupUploadService;
                    $filename = $upload->process($request->file('photo_pickup'));

                    $redeem->image()->create([
                        'image' => $filename
                    ]);
                }

                $redeem->transaction_number = $redeem->transaction_number ?? Random::generate(10, 1234567890);
                $redeem->no_resi = $redeem->transaction_number;
                $redeem->status = $request->status;
                $redeem->jenis_pengiriman = $request->jenis_pengiriman;
                $redeem->save();

                DB::commit();

            }elseif($request->redeem_type == 'delivery'){

                if($request->photo_delivery && $request->hasFile('photo_delivery')){

                    if(! is_null($redeem->image)){
                        $this->deleteOldImage($redeem, 'deliverys');
                    }

                    $upload = new PhotoDeliveryUploadService;
                    $filename = $upload->process($request->file('photo_delivery'));

                    $redeem->image()->create([
                        'image' => $filename
                    ]);
                }
                
                $redeem->transaction_number = $redeem->no_resi ?? $request->no_resi;
                $redeem->no_resi = $request->no_resi;
                $redeem->status = $request->status;
                $redeem->jenis_pengiriman = $request->jenis_pengiriman;
                $redeem->save();

                DB::commit();
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Edit Data'
            ]);
            
        } catch (\Exception $e) {

            DB::rollback();

             return response()->json([
                'success' => false,
                'message' => 'Gagal Edit Data'
            ]);

            
        }
    }

    public function delete(Request $request)
    {
        $product_user  = ProductUser::findOrFail($request->id);

        $product_user->delete();

          return redirect()->route('admin.product.redeem.list')->with('success', 'Berhasil Hapus Data');
    }

    private function deleteOldImage($model, $path)
    {
        $oldimage = url('storage/' . $path . '/' . $model->image?->image);

        if(file_exists($oldimage)){
            unlink($oldimage);
        }

        $model->image()?->delete();
    }
}
