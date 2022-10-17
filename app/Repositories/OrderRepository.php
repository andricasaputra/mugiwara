<?php  

namespace App\Repositories;

use App\Contracts\PaymentTypenterface;
use App\Models\Accomodation;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use App\Notifications\Admin\AdminOrderCreatedNotifications;
use App\Notifications\Orders\OrderDetailEmailNotification;
use App\Notifications\Orders\SendOrderCreatedNotifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Xendit\Xendit;

class OrderRepository
{
	public function create($request)
	{
		DB::beginTransaction();

		try {

			$accomodation = Accomodation::findOrFail($request->accomodation_id);
			$room = Room::findOrFail($request->room_id);
			$type_id = $room->type?->id;

	        $rooms = Room::where('accomodation_id', request()->accomodation_id)
	            ->where('type_id', $type_id)
	            ->get();

	        $notAvailable = Room::where('accomodation_id', request()->accomodation_id)
	                    ->where('type_id', $type_id)
	                    ->where('status', '!=' ,'available')
	                    ->get();

	        $available = Room::where('accomodation_id', request()->accomodation_id)
	                    ->where('type_id', $type_id)
	                    ->where('status', '!=', 'stayed')
	                    ->get();

	        $stayed_date = $notAvailable->pluck('stayed_untill')->filter(fn($data) => !is_null($data))->toArray();

	        $booked_date = $notAvailable->pluck('booked_untill')->filter(fn($data) => !is_null($data))->toArray();

	        $rooms = $rooms->count();


	        $end_date = \Carbon\Carbon::parse($request->check_in_date)->addDays(request()->stay_day);

	        if(in_array($end_date, $booked_date)){
	            $rooms = $rooms - 1;
	        }

	        if(in_array($end_date, $stayed_date)){
	            $rooms = $rooms - 1;
	        }

	         if($rooms == 0){
	        	throw new \Exception('Kamar sudah penuh.');
	        }

			if($request->check_in_date < date('Y-m-d')){
				throw new \Exception('Tidak dapat memilih tanggal lampau.');
			}

			if ($room->isBooked() || $room->isStayed()) {

				$room_id = $accomodation->room->where('type_id', $type_id)->first()?->id;

			} else {
				
				$room_id = $room->id;
			}

			$discount_percent = $room->discount_type == 'percent' 
	                ? (int) $room->discount_amount / 100 
	                : NULL;

			$discount_amount = $room->discount_type == 'percent' 
	                ? $room->price * $discount_percent
	                : $room->discount_amount;

			$total_price =  ($room->price * $request->stay_day)- (int) $discount_amount;

			$order = Order::create([
				'booking_code' => 'capsuleinn-' . Uuid::uuid4()->toString(),
				'accomodation_id' => $accomodation->id,
				'room_id' => $room_id,
				'user_id' => $request->user()->id,
				'check_in_date' => $request->check_in_date,
				'check_in_time' => $request->check_in_time,
				'stay_day' => $request->stay_day,
				'total_guest' => $request->total_guest,
				'normal_price' => $room->price,
				'discount_type' => $room->discount_type,
				'discount_percent' => $room->discount_amount,
				'discount_amount' => $discount_amount,
				'total_price' => $total_price,
				'check_out_date' => Carbon::parse($request->check_in_date)->addDays($request->stay_day),
				'order_status' => 'booked',

			]);

			$room = Room::findOrFail($room->id);

			$room->status = 'booked';
			$room->booked_untill = now()->addDays(1);
			$room->total_order = $room->order()->count() + 1;
			$room->save();

			$this->sendNotification($request, $order);
			
			DB::commit();

			return $order;
			
		} catch (Exception $e) {

			DB::rollback();

			return response()->json([
				'message' => 'Error create order, Error : ' . $e->getMessage()
			]);
		}
	}

	public function updateStatus($status, $request)
	{
		$payment = Payment::where('charge_id', $request->charge_id)->first();

		$payment->update(['status' => $status['status']]);

		return $payment;
	}

	public function createInvoices()
	{

		Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

		$params = ['external_id' => 'demo_147580196270',
		    'payer_email' => 'sample_email@xendit.co',
		    'description' => 'Trip to Bali',
		    'amount' => 32000,
		    'for-user-id' => '5c2323c67d6d305ac433ba20'
		];

		$createInvoice = \Xendit\Invoice::create($params);
		dd($createInvoice);
	}

	public function createInvoice($args) {

        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        $date = new \DateTime();
        $redirectUrl = '';
        $defParams = [
            'external_id' => 'native8-checkout-demo-' . $date->getTimestamp(),
            'payer_email' => 'invoice+demo@xendit.co', 
            'description' => 'Vanilla PHP Checkout Demo', 
            'failure_redirect_url' => $redirectUrl, 
            'success_redirect_url' => $redirectUrl
        ];

        $defParams['failure_redirect_url'] = $args['redirect_url'];
        $defParams['success_redirect_url'] = $args['redirect_url'];
        $post = [];

        foreach ($args as $k => $v) {
            $post[$k] = $v;
        }
        
        $params = array_merge($defParams, $post);

        // return json_encode($params);

        header('Content-Type: application/json');
        $response = [];

        try {
            Xendit::setApiKey($apiKey);

            $response = \Xendit\Invoice::create($params);
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            $response['message'] = $e->getMessage();
        }

        return json_encode($response);
    }

    protected function sendNotification($request, $order)
    {

        $customer_title = 'Pesanan Kamar Berhasil';
        $customer_message = "Selamat, anda telah berhasil melakukan pemesanan kamar dihotel {$order->accomodation?->name}.";

        $user_title = 'Ada Pesanan Kamar Masuk';
        $user_message = 'Seseorang baru saja memesan sebuah kamar, silahkan menuju halaman pemesanan untuk detail lebih lanjut';

        $customer = Customer::find($request->user()->id);
        $user = User::find($request->user()->id);

        $user?->notify(
       		new OrderDetailEmailNotification(
       			$order
       		)
       	);
        
       	$user?->notify(
       		new SendOrderCreatedNotifications(
       			$order, $customer_title, $customer_message
       		)
       	);

       	$customer?->notify(
       		new SendOrderCreatedNotifications(
       			$order, $customer_title, $customer_message
       		)
       	);

       	$admin = User::admin()->first();

		$office = Office::where('accomodation_id', $order->accomodation_id)->first();

		event(new \App\Events\OrderBroadcastEvent($user_title));

		// Notify admin and employee
		$admin->notify(
			new AdminOrderCreatedNotifications(
				$order, $user_title, $user_message
			)
		);
		
		if(!is_null($office) && count($office?->users) > 0){

			foreach($office->users as $employee){
				$employee->user?->notify(
					new AdminOrderCreatedNotifications(
						$order, $user_title, $user_message
					)
				);
			}
		}


    }
}