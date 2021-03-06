<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room()
    {
        return $this->hasMany(Room::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function ratings()
    {
        return $this->hasMany(AccomodationRatings::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Room::class,
            'id',
            'reviewable_id', 
            'id',
            'id'
        );
    }
}
