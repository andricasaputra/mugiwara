<?php

namespace App\Models;

use App\Models\Scopes\CustomerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends User
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $guarded = ['id'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new CustomerScope);
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'user_id');
    }
    public function accountPoints()
    {
        return $this->hasMany(AccountPoint::class, 'user_id');
    }

    public function banned()
    {
        return $this->hasOne(BannedUser::class, 'user_id');

    }

    public function vouchers()
    {
        return $this->hasManyThrough(
            Voucher::class, 
            AccountPoint::class,
            'user_id',
            'id',
            'id',
            'voucher_id'
        );
    }
}
