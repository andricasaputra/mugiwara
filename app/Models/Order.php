<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'accomodation_id',
        'room_id',
        'user_id',
        'check_in_date',
        'check_in_time',
        'stay_day',
        'normal_price',
        'discount_type',
        'discount_percent',
        'discount_amount',
        'total_price'
    ];

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function isPaid() : bool
    {
        return $this->hasOne(Payment::class)
            ->where('status', 'SUCCEEDED')
            ->orWhere('status', 'COMPLETED');
    }

    public function isExpired() : bool
    {
        return $this->hasOne(Payment::class)->where('status', 'EXPIRED');
    }

    public function isPending() : bool
    {
        return $this->hasOne(Payment::class)->where('status', 'PENDING');
    }
}
