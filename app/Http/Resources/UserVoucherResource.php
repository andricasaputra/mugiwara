<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserVoucherResource extends JsonResource
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
            'user'=> [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
            ],
            'voucher' => new Voucher($this->voucher),
            'is_used' => $this->is_used
        ];
    }
}
