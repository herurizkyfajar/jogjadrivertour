<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyTour extends Model
{
    protected $fillable = [
        'image',
        'negara_asal',
    ];

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'my-tours/')) {
            return asset('storage/' . $this->image);
        }
        return asset($this->image);
    }
}
