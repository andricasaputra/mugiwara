<?php  

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Payments\Ewallet;
use App\Models\Payments\VirtualAccount;
use App\Repositories\PaymentsType;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PaymentsRepository
{
	public function create($payment, $order, $request)
	{
		$type  = new PaymentsType();
		$type = $type->create($request, $order, $payment);

		return $type->payment()->updateOrCreate(
			[
				'type_id' => $type->id,
				'order_id' => $order->id
			],
			[
				'booking_code' => $request->booking_code,
				'user_id' => auth()->id(),
				'payment_id' => $payment['id'],
				'voucher_id' => $request->voucher_id ?? NULL,
				'payment_id' => $type->id,
				'currency' => $payment['currency'],
				'amount' => $request->amount,
				'discount_type' => $request->discount_type ??= NULL,
				'discount_amount' => $request->discount_amount ??= NULL,
				'tax' => $request->tax ??= NULL,
				'status' => $payment['status'],
			]
		);
	}

	public function pay($payment, $request)
	{
		return $payment;
	}

	public function updateStatusEwallet($status, $request)
	{
		$ewallet = Ewallet::where('ewallet_id', $request->ewallet_id)
			->whereHas('payment', function($query) use ($request){
				$query->where('booking_code', $request->booking_code);
			})->first();

		if(! $ewallet){
			throw new \Exception("Pembayaran tidak ditemukan", 1);
			
		}

		$ewallet->payment()->update(['status' => $status['status']]);

		return $ewallet->payment ?? NULL;
	}

	public function updateStatusVirtualAccount($status, $request)
	{
		$va = VirtualAccount::where('external_id', $request->external_id)
			->whereHas('payment', function($query) use ($request){
				$query->where('booking_code', $request->booking_code);
			})->first();

		if(! $va){
			throw new \Exception("Pembayaran tidak ditemukan", 1);
			
		}

		$va->payment()->update(['status' => $status]);

		return $va->payment ?? NULL;
	}

	public function lists($lists)
	{
		$newList = [];
       foreach($lists as $list){
            if($list['channel_code'] == 'BCA'){
                $list['image'] = '/storage/payments/bca.png';
            }elseif($list['channel_code'] == 'BRI'){
                $list['image'] = '/storage/payments/bri.png';
            }elseif($list['channel_code'] == 'MANDIRI'){
                $list['image'] = '/storage/payments/mandiri.png';
            }elseif($list['channel_code'] == 'BNI'){
                $list['image'] = '/storage/payments/bni.png';
            }elseif($list['channel_code'] == 'OVO'){
                $list['image'] = '/storage/payments/ovo.png';
            }elseif($list['channel_code'] == 'LINKAJA'){
                $list['image'] = '/storage/payments/linkaja.png';
            }elseif($list['channel_code'] == 'DANA'){
                $list['image'] = '/storage/payments/dana.png';
            }

            $newList[] = $list;
       }
	}
}