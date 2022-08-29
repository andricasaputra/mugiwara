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
            "payment" => [
                'id' => $this->payment?->id,
                'payment_type' => $this->payment?->payable_type == "App\\Models\\Payments\\Ewallet" ? 'EWALLET' : 'VIRTUAL_ACCOUNT',
                'order_id' => $this->payment?->order_id,
                'booking_code' => $this->payment?->booking_code,
                'currency' => $this->payment?->currency,
                'amount' => $this->payment?->amount,
                'discount_type' => $this->payment?->discount_type,
                'discount_amount' => $this->payment?->discount_amount,
                'tax' => $this->payment?->tax,
                'status' => $this->payment?->status,
                
                $this->mergeWhen($this->payment?->payable_type == "App\\Models\\Payments\\VirtualAccount", [
                    'external_id' => $this->payment?->payable?->external_id,
                    'bank_code' => $this->payment?->payable?->bank_code,
                    'image' => $this->payment?->payable?->bank_code != NULL ? url('storage/payments/' . strtolower($this->payment?->payable?->bank_code) . '.png') : NULL, 
                    'merchant_code' => $this->payment?->payable?->merchant_code,
                    'account_number' => $this->payment?->payable?->account_number,
                    'name' => $this->payment?->payable?->name,
                    'payment_time' => $this->payment?->payable?->payment_time,
                    'expiration_date' => $this->payment?->payable?->expiration_date,
                ]),

                $this->mergeWhen($this->payment?->payable_type == "App\\Models\\Payments\\Ewallet", [
                    'ewallet_id' => $this->payment?->payable?->ewallet_id,
                    'channel_code' => $this->payment?->payable?->channel_code,
                    'image' => $this->payment?->payable?->channel_code != NULL ? url('storage/payments/' . strtolower(str_replace("ID_", "", $this->payment?->payable?->channel_code)) . '.png') : NULL, 
                    'mobile_number' => $this->payment?->payable?->mobile_number,
                    'payment_time' => $this->payment?->payable?->payment_time,
                ]),

                'created_at' => $this->payment?->created_at,
                'created_at' => $this->payment?->created_at,
                'expired_at' => $this->payment?->expired_at,
                'voucher' => $this->payment?->voucher,
            ],
            "room" => new RoomResource($this->room),
            "refund" => $this->refund,
        ];
    }
}
