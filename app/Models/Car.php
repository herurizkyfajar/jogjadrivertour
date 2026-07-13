<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'image',
        'passengers',
        'luggage',
        'type',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) return asset('template/assets/images/cars/avanza.webp');
        if (str_starts_with($this->image, 'cars/')) {
            return asset('storage/' . $this->image);
        }
        return asset($this->image);
    }
}
