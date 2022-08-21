<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemanMenu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function role()
    {
        return $this->hasMany(ManajemanMenuRole::class, 'menu_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
