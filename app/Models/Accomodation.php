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

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
