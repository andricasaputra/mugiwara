<?php

namespace App\Models;

use App\Models\OfficeUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(OfficeUser::class);
    }

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }
}
