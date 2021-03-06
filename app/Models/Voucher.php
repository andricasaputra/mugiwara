<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function accountPoints()
    {
        return $this->hasMany(AccountPoint::class, 'voucher_id');
    }

    public function account()
    {
        return $this->hasOneThrough(
            Account::class, AccountPoint::class, 'voucher_id', 'id', 'id', 'user_id'
        );
    }

    public function scopeIsActive($query)
    {
        $query->where('is_active', 1);
    }
}
