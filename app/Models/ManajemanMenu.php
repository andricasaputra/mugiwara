<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemanMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'amount_child',
        'is_active',
        'created_at'
    ];

    public function role()
    {
        return $this->hasMany(ManajemanMenuRole::class, 'menu_id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function childs()
    {
        return $this->hasMany(ManajemenSubMenu::class);
    }
}
