<?php

namespace App\Models;

use App\Models\Scopes\CustomerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends User
{
    use HasFactory;

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
}
