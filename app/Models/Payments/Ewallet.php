<?php

namespace App\Models\Payments;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ewallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
