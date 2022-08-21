<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Aktif' : 'Tidak Aktif'
        );
    }
}
