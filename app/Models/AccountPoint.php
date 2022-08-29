<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPoint extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class, 'affiliate_id');
    }

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
