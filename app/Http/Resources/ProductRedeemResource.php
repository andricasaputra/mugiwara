<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductRedeemResource extends JsonResource
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
            'transaction_number' => $this->redeem_type == 'pickup' ? $this->transaction_number : $this->no_resi,
            'status' => $this->status,
            'jenis_pengiriman' => $this->jenis_pengiriman,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'product' => $this->product,
            'image' => $this->redeem_type == 'pickup' ? url('storage/products/pickups/' . $this->image?->image)  : url('storage/products/deliverys/' . $this->image?->image),
        ];
    }
}
