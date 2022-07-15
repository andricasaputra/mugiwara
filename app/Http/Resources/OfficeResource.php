<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
            ],
            'accomodation' => [
                'id' => $this->accomodation?->id,
                'name' => $this->accomodation?->name,
            ],
            'name' => $this->name,
            'address' => $this->address,
            'mobile_number' => $this->mobile_number,
            'type' => $this->type == 'main_office' ? 'Kanotr Utama' : 'Kanotr Cabang',

        ];
    }
}
