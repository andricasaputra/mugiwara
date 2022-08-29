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

    public function roomAvailable()
    {
        return $this->hasMany(Room::class)->where('status', 'available');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function districts()
    {
        return $this->belongsTo(District::class);
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
            'accomodation_id',
            'reviewable_id', 
            'id',
            'id'
        );
    }
}
