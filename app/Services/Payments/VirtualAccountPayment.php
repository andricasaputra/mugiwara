<?php  

namespace App\Services\Payments;

use App\Contracts\PaymentServiceInterface;

class VirtualAccountPayment implements PaymentServiceInterface
{
	public function pay()
	{
		$ewalletChargeParams = [
		    'reference_id' => 'test-reference-id',
		    'currency' => 'IDR',
		    'amount' => 50000,
		    'checkout_method' => 'ONE_TIME_PAYMENT',
		    'channel_code' => 'OVO',
		    'channel_properties' => [
		        'success_redirect_url' => 'https://yourwebsite.com/order/123',
		    ],
		    'metadata' => [
		        'meta' => 'data'
		    ]
		];

		$createEWalletCharge = \Xendit\EWallets::createEWalletCharge($ewalletChargeParams);
		var_dump($createEWalletCharge);
	}
}