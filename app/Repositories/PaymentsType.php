<?php  

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Payments\Ewallet;
use App\Models\Payments\VirtualAccount;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PaymentsType
{
	public function create($request, $order, $payment)
	{
		if(request()->channel_category == 'EWALLET'){

			return $this->createEwalletPayment($request, $order, $payment);

		}elseif(request()->channel_category == 'VIRTUAL_ACCOUNT'){

			return $this->createVirtualAccountPayment($request, $order, $payment);

		}

		throw new \Exception("channel_category not found");
	}

	protected function createEwalletPayment($request, $order, $payment)
	{

		$payment = Ewallet::updateOrCreate(
			[
				'order_id' => $order->id,
				'channel_code' => $request->channel_code,
				'mobile_number' => $request->mobile_number,
			],
			[
				'ewallet_id' => $payment['id'],
				'payment_time' => $payment['created'],
				'payload' => json_encode($payment),
				'success_redirect_url' => $payment['channel_properties']['success_redirect_url'] ?? NULL,
				'desktop_web_checkout_url' => $payment['actions']['desktop_web_checkout_url'] ?? NULL,
				'mobile_web_checkout_url' => $payment['actions']['mobile_web_checkout_url'] ?? NULL,
				'callback_url' => $payment['callback_url'] ?? NULL,
			]
		);

		return $payment;
	}

	protected function createVirtualAccountPayment($request, $order, $payment)
	{
		
		$payment = VirtualAccount::updateOrCreate(
			[
				'order_id' => $order->id,
				'external_id' => $payment['external_id'],
				'bank_code' => $payment['bank_code'],
			],
			[
				'owner_id' => $payment['owner_id'],
				'merchant_code' => $payment['merchant_code'],
				'account_number' => $payment['account_number'],
				'name' => $payment['name'],
				'payment_time' => now(),
				'expiration_date' => $payment['expiration_date'],
				'payload' => json_encode($payment),
			]
		);

		return $payment;
	}

}