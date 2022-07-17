<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccomodationResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'province' => $this->province->name,
            'regency' => $this->regency->name,
            'address' => $this->address,
            'description' => $this->description,
            'location' => [
                'lang' => $this->lang,
                'lat' => $this->lat
            ],
            'ratings_avg' => number_format($this->reviews_avg_rating, 1) ?? 0.0,
            'rooms' =>  RoomResource::collection($this->whenLoaded('roomAvailable')),
        ];
    }
}
