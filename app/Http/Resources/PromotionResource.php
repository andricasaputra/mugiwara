<?php

namespace App\Http\Resources;

use App\Models\Accomodation;
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
            'name' =>  $this->name ?? 'No Data',
            'description' =>  $this->description,
            'is_active' => $this->getRawOriginal('is_active'),
            'start_date' => $this->start_date,
             'end_date' => $this->end_date,
            'created_at' =>  $this->created_at,
            'accomodation_id' => $this->accomodation_id,
            'accomodation_name' => Accomodation::find($this->accomodation_id)?->name,
            'room_number' => $this->room_number,
            'room_type' => $this->room_type,
            'images' => PromotionImageResource::collection($this->images)
        ];
    }
}
