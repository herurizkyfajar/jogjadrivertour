<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;

protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'image',
        'location',
        'city',
        'rating',
        'tour_count',
        'maps_embed',
        'maps_link',
        'gallery_images',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function galleries()
    {
        return $this->hasMany(DestinationGallery::class)->orderBy('sort_order');
    }
}
