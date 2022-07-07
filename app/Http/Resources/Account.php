<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Account extends JsonResource
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
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'gender' => $this->account->gender,
            'birth_date' => $this->account->birth_date,
            'refferral_code' => $this->account->refferral_code,
            'image' => $this->account->avatar ? Storage::disk('local')->url('data/'. $this->account->avatar) : null,
            'created_at' => $this->created_at->isoFormat('dddd, D MMMM Y'),
            'updated_at' => $this->updated_at->isoFormat('dddd, D MMMM Y'),
        ];
    }
}
