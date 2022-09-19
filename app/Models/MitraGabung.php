<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraGabung extends Model
{
    use HasFactory;
    protected $table = 'mitra_gabungs';
    protected $guarded = ['id'];
}
