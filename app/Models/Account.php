<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
       return $this->hasManyThrough(
            Voucher::class, AccountPoint::class, 'user_id' ,'id', 'user_id', 'voucher_id'
        );
    }
}
