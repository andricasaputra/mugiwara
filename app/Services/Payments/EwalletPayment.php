<?php  

namespace App\Services\Payments;

use App\Contracts\PaymentServiceInterface;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Xendit\Xendit;

class EwalletPayment implements PaymentServiceInterface
{
	public function pay(Request $request)
	{
		Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
		$ewalletChargeParams = [
		    'reference_id' => 'capsuleinn-' . Uuid::uuid4()->toString(),
		    'currency' => config('xendit.currency'),
		    'amount' => $request->amount,
		    'checkout_method' => config('xendit.checkout_method'),
		    'channel_code' => $request->channel_code,
		    'channel_properties' => [
		        'success_redirect_url' => config('xendit.success_redirect_url'),
		    ],
		    'metadata' => [
		        'meta' => 'data'
		    ]
		];

		return \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
	}
}