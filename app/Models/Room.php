<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'type_id', 'id');
    }
}
