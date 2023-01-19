<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOffline extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->hasOne(PaymentOffline::class, 'order_offline_id');
    }
}
