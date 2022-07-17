<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function isAvailable() : bool
    {
        return $this->attributes['status'] == 'available';
    }

    public function isBooked() : bool
    {
        return $this->attributes['status'] == 'booked';
    }

    public function isStayed() : bool
    {
        return $this->attributes['status'] == 'stayed';
    }
}
