<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'order_id' => $this->id,
            'booking_code' => $this->booking_code,
            'accomodation' => [
                'id' => $this->accomodation?->id,
                'name' => $this->accomodation?->name
            ],
            'room' => [
                'id' => $this->room?->id,
                'room_type' => $this->room?->type?->name,
                'number' => $this->room?->room_number
            ],
            'user_id' => [
                'id' => $this->user?->id,
                'email' => $this->user?->email,
                'name' => $this->user?->name,
                "mobile_verified_at" => $this->user?->mobile_verified_at,
                "mobile_number" => $this->user?->mobile_number,
            ],
            'check_in_date' => $this->check_in_date,
            'check_in_time' => $this->check_in_time,
            'stay_day' => $this->stay_day,
            'check_out_date' => $this->check_out_date->format('Y-m-d'),
            'total_guest' => $this->total_guest,
            'normal_price' => $this->normal_price, 
            'discount_type' => $this->discount_type,

            $this->mergeWhen($this->discount_type == 'percent', [
                "discount_percent" =>  $this->discount_percent
            ]),

            'discount_amout' => $this->discount_amount,
            'total_price' => $this->total_price,
            'order_status' => $this->order_status,
            'total_order' => $this->room?->total_order
        ];
    }
}
