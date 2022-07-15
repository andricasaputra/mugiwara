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
            'mobile_verified_at' => $this->mobile_verified_at,
            'gender' => $this->account->gender ?? null,
            'birth_date' => $this->account->birth_date ?? null,
            'refferral_code' => $this->account->refferral_code ?? null,
            'avatar' => $this->account?->avatar ? Storage::disk('public')->url('avatars/' . $this->account->avatar) : null,
            'point' => $this->account->point ?? 0,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
