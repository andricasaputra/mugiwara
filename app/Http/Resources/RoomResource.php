<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->hasVailableRoom();
    }

    protected function hasVailableRoom()
    {
        if (is_null($this->type)) return [];
        if ($this->facilities->isEmpty()) return [];

        return [
            'id' => $this->id,
            'room_type' => ucwords($this->type->name),
            'description' => $this->description,
            "room_number" => $this->room_number,
            "max_guest" => $this->max_guest,
            'status' => $this->status,

            $this->mergeWhen($this->status == 'booked', [
                "booked_untill" => $this->booked_untill,
            ]),

            "normal_price" => $this->price,
            'is_in_discount' => $this->discount_type ? true : false,

            $this->mergeWhen(! is_null($this->discount_type), [
                
                "discount_type" => $this->discount_type,

                $this->mergeWhen($this->discount_type == 'percent', [
                   "discount_percent" =>  (int) $this->discount_amount / 100
                ]),

                "discount_amount" => $this->discount_type == 'percent' 
                ? $this->price * ((int) $this->discount_amount / 100) 
                : $this->discount_amount,
            ]),

            'total_price' => $this->discount_type == 'percent' 
                ? $this->price - ($this->price * ((int) $this->discount_amount / 100)) 
                : $this->price - $this->discount_amount,
            'facilities' => FacilityResource::collection($this->whenLoaded('facilities')),
            'images' => ImageResource::collection($this->images),
            'reviews' => ReviewsResource::collection($this->reviews),
            'ratings_avg' => number_format($this->reviews_avg_rating, 1) ?? 0.0,
            'reviews_count' => $this->reviews_count,
            'reviews_avg_rating' => $this->reviews_avg_rating
        ];
    }
}
