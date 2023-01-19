<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categoryPost()
    {
        return $this->belongsTo(CategoryPost::class);
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function visitors()
    {
        return $this->hasMany(PostVisit::class);
    }
}
