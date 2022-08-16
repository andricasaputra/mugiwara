<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $check_in_date = Carbon::parse($this->check_in_date);
        $stay_day = $this->stay_day;

        $check_out_date = $check_in_date->addDays($stay_day);

        if($check_in_date > now() && $check_out_date < now()){
            $status = 'Berlangsung';
        } elseif($check_out_date < now()) {
            $status = 'Check out';
        } else{
             $status = 'Check In';
        }

        return [
            "check_in_date" => $this->check_in_date,
            "check_in_time" =>$this->check_in_time,
            "stay_day" => $this->stay_day,
            "total_guest" => $this->total_guest,
            "normal_price" => $this->normal_price,
            "discount_type" => $this->discount_type,
            "discount_percent" => $this->discount_percent,
            "discount_amount" => $this->discount_amount,
            "total_price" => $this->total_price,
            "created_at" => $this->created_at,
            "booking_status" => $status,
            'order_status' => $this->order_status,
            "payment" => $this->payment,
            "room" => new RoomResource($this->room),
            ];
    }
}
