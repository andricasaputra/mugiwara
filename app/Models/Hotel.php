<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function flashSales()
    {
        return $this->hasMany(FlashSale::class);
    }
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
    public function hotelOffices()
    {
        return $this->hasMany(HotelOffice::class);
    }
}
