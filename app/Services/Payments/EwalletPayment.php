<?php  

namespace App\Services\Payments;

use App\Contracts\PaymentServiceInterface;
use Illuminate\Http\Request;
use Xendit\Xendit;

class EwalletPayment implements PaymentServiceInterface
{
	public function createPayment(Request $request)
	{
		Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

		$ewalletChargeParams = [
		    'reference_id' => $request->booking_code,
		    'currency' => config('xendit.currency'),
		    'amount' => $request->amount,
		    'checkout_method' => config('xendit.checkout_method'),
		    'channel_code' => $request->channel_code,
		    'channel_properties' => [
		        'success_redirect_url' => config('xendit.success_redirect_url'),
		         'mobile_number' => $request->mobile_number,
		    ],
		    'metadata' => [
		        'meta' => 'data'
		    ],
		   
		];
		
		return \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
	}

	public function pay()
	{
		//
	}
}