<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Facility extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function room()
    {
        return $this->belongsToMany(Room::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords(str_replace("_", " ", $value)),
        );
    }

}
