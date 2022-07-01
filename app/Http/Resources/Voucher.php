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
            'image' => $this->image ? Storage::disk('local')->url('data/'. $this->image) : null,
            'discount_amount' => $this->discount_amount ?? null,
            'discount_percent' => $this->discount_percent ?? '0',
            'discount_type' => $this->discount_type,
            'starts_at' => $this->starts_at,
            'is_active' => $this->is_active,
            'expires_at' => $this->expires_at,
            'point_needed' => $this->point_needed,
            'created_at' => $this->created_at->isoFormat('dddd, D MMMM Y'),
            'updated_at' => $this->updated_at->isoFormat('dddd, D MMMM Y'),
        ];
    }
}
