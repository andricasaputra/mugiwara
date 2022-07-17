<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function payable()
    {
        return $this->morphTo();
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPaid() : bool
    {
        return $this->attributes['status'] == 'SUCCEEDED' 
                || $this->attributes['status'] == 'COMPLETED';
    }

    public function isExpired() : bool
    {
        return $$this->attributes['status'] == 'EXPIRED';
    }

    public function isPending() : bool
    {
        return $$this->attributes['status'] == 'PENDING';
    }
}
