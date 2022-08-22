<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Voucher extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'uses_count' => $this->uses_count,
            'max_uses' => $this->max_uses,
            'max_uses_user' => $this->max_uses_user,
            'type' => $this->type,
            'category' => $this->category,
            'image' => Storage::disk('public')->url('vouchers/' . $this->image),
            'discount_type' => $this->discount_type,
            $this->mergeWhen($this->discount_type == 'fixed', [
                  'discount' => $this->discount_amount ?? null,
            ]),
            $this->mergeWhen($this->discount_type == 'percent', [
                   'discount' => $this->discount_percent,
            ]),
            'is_active' => $this->is_active,
            'starts_at' => $this->starts_at,
            'expires_at' => $this->expires_at,
            'point_needed' => $this->point_needed,
        ];
    }
}
