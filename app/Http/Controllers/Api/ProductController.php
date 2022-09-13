<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as ResourcesPost;
use App\Http\Resources\Product as ResourcesProduct;
use App\Models\AccountPoint;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\User;
use App\Notifications\ProductReedemSuccessNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('image')->paginate(10);

        $products->appends(request()->all());

        return ResourcesProduct::collection($products)
                ->additional([
            'status' => 'success',
            'message' => 'List Products'
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $product = new ResourcesProduct($product);

        return $product
                ->additional([
                    'status' => 'success',
                    'message' => 'Detail Product',
                ]);
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            //'redem_type' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $product = Product::findOrFail($request->product_id);

            if($product->stock == 0){
                return response()->json([
                    'message' => 'Maaf stok produk saat ini sedang kosong'
                ]);
            }

            $account = $request->user()->account;

            if(! $account){
                return response()->json([
                    'message' => 'Akun Tidak Ditemukan, Silahkan lakukan registrasi data'
                ]);
            }

            if($product->point_needed > $account->point){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Poin anda tidak cukup untuk menukarkan produk ini',
                ], 400);
            }

            $trx_number = Random::generate(15, 1234567890);

            $product_user = ProductUser::create([
                'user_id' => $request->user()->id,
                'product_id' => $request->product_id,
                //'redem_type' => $request->redem_type,
                'transaction_number' => $trx_number ,
            ]);

            $point_after = $account->point - $product->point_needed;

            $accountPoints = AccountPoint::create([
                'user_id' => $request->user()->id,
                'product_id' => $product->id,
                'before' => $account->point,
                'after' =>  $point_after,
                'mutation' => $product->point_needed,
                'type' => 'point_out',
                'description' => 'Penukaran produk merchandise',
                'transaction_number' => $trx_number ,
            ]);

            $account->update([
                'point' => $point_after
            ]);

            $product->update([
                'stock' => $product->stock - 1
            ]);

            //Terimaksih telah menukarkan point anda, Gunakan sebelum batas waktu yang sudah ditentukan

            $admin = User::admin()->first();

            $notification_user = new ProductReedemSuccessNotification(
                $accountPoints,
                $product_user->load(['user', 'product']),
                'Terimaksih telah menukarkan point anda, Gunakan sebelum batas waktu yang sudah ditentukan'
            );

            $notification_admin = new ProductReedemSuccessNotification(
                $accountPoints,
                $product_user->load(['user', 'product']),
                'Terdapat penukaran merchandise!'
            );

            $customer = Customer::find($request->user()->id);
            $user = User::find($request->user()->id);

            $user?->notify($notification_user);
            $customer?->notify($notification_user);

            $admin->notify($notification_admin); 

            DB::commit();

            return response()->json([
                'data' => $product_user->load(['userp.image', 'product']),
                'message' => 'Penukaran produk merchandise berhasil!, mohon menunggu, tim kami akan segera menghubungi anda untuk konfirmasi penukaran'
            ]);
                
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
