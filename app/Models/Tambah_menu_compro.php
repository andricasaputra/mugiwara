<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tambah_menu_compro extends Model
{
    use HasFactory;

    protected $table = 'tambah_menu_compro';

    protected $fillable = [
        'nama_menu',
        'url_menu'
    ];
}
