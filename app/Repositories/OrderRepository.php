<?php  

namespace App\Repositories;

use App\Contracts\PaymentTypenterface;
use App\Models\Accomodation;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Room;
use App\Notifications\Orders\SendOrderCreatedNotifications;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class OrderRepository
{
	public function create($request)
	{
		$accomodation = Accomodation::findOrFail($request->accomodation_id);
		$room = Room::findOrFail($request->room_id);

		if ($room->isBooked() || $room->isStayed()) {
			throw new \Exception('Kamar tidak tersedia');
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
			'room_id' => $room->id,
			'user_id' => $request->user()->id,
			'check_in_date' => $request->check_in_date,
			'check_in_time' => $request->check_in_time,
			'stay_day' => $request->stay_day,
			'normal_price' => $room->price,
			'discount_type' => $room->discount_type,
			'discount_percent' => $room->discount_amount,
			'discount_amount' => $discount_amount,
			'total_price' => $total_price
		]);

		$request->user()->notify(new SendOrderCreatedNotifications($order));

		return $order;
	}

	public function updateStatus($status, $request)
	{
		$payment = Payment::where('charge_id', $request->charge_id)->first();

		$payment->update(['status' => $status['status']]);

		return $payment;
	}
}