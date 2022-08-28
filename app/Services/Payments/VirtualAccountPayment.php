<?php  

namespace App\Services\Payments;

use App\Contracts\PaymentServiceInterface;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;

class VirtualAccountPayment implements PaymentServiceInterface
{
	public function createPayment(Request $request)
	{
		Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

		  $params = [ 
		    "external_id" => 'va-' . Uuid::uuid4()->toString(),
		    "bank_code" => $request->bank_code,
		    "name" => $request->name,
		    "is_closed" => true,
   			"expected_amount" => $request->amount
		  ];

		  return  \Xendit\VirtualAccounts::create($params);
	}

	public function pay($request)
	{

		$username = env('XENDIT_SECRET_KEY') . ":";
		$password = "";

		$data = ['amount' => $request->amount];

		$response = Http::asForm()
			->accept('application/json')
			->withBasicAuth($username, $password)
			->post('https://api.xendit.co/callback_virtual_accounts/external_id='.$request->external_id.'/simulate_payment', $data);

		return $response->json();
	}
}