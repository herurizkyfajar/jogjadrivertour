<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'image',
        'price',
        'discount_price',
        'duration_info',
        'category',
        'tag',
        'rating',
        'review_count',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getSlugAttribute($value)
    {
        return $value;
    }

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'tours/')) {
            return asset('storage/' . $this->image);
        }
        return asset($this->image);
    }
}
