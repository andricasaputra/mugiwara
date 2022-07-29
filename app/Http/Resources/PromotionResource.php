<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'id' =>  $this->id,
            'name' =>  $this->name,
            'description' =>  $this->description,
            'is_active' => $this->is_active,
            'start_date' => $this->start_date,
             'end_date' => $this->end_date,
            'created_at' =>  $this->created_at,
            'accomodation_id' => $this->accomodations?->first()?->accomodation_id,
            'room_id' => $this->accomodations?->pluck('room_id'),
            'images' => PromotionImageResource::collection($this->images)
        ];
    }
}
