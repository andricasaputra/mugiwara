<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends User
{
    use HasFactory;

    protected $table = 'users';
    protected $guarded = ['id'];

    public function account()
    {
        return $this->hasOne(Account::class, 'user_id');
    }
}
