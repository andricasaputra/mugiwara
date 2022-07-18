<?php

namespace App\Http\Resources;

use App\Models\Account;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
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
            'user' => $this->user->name,
            'avatar' => url('storage/avatars/' . $this->user?->account?->avatar),
            'comment' => $this->comment,
            'rating' => $this->rating,
        ];
    }
}
