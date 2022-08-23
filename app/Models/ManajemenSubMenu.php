<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenSubMenu extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'url',
        'is_active',
    ];

    public function parent()
    {
        return $this->belongsTo(ManajemanMenu::class);
    }
}
