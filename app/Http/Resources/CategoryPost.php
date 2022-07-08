<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;


class CategoryPost extends JsonResource
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
            'created_at' => $this->created_at->isoFormat('dddd, D MMMM Y'),
            'updated_at' => $this->updated_at->isoFormat('dddd, D MMMM Y'),
            'posts' => Post::collection($this->posts()->get()),
        ];
    }
}
