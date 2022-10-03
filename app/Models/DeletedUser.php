<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    use HasFactory;

     protected $guarded = [];

     public function user()
     {
        return $this->belongsTo(User::class);
     }

     public function reason()
     {
        return $this->belongsTo(DeleteReason::class, 'delete_reason_id');
     }
}
