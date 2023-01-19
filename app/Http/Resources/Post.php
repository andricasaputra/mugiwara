<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'category' => $this->categoryPost?->name,
            'postedBy' => $this->user?->name,
            'title' => $this->title,
            'body' => $this->body,
            'slug' => $this->slug,
            'image' => url('storage/posts/' .  $this->image),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->isoFormat('dddd, D MMMM Y'),
            'updated_at' => $this->updated_at->isoFormat('dddd, D MMMM Y'),
            'likes_total' =>$this->likes()->sum('like_count'),
            'visitors_total' =>$this->visitors()->sum('visitor_count')
        ];
    }
}
