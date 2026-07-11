<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'is_active'];

    protected static function booted(): void
    {
        static::creating(function (City $city) {
            $city->slug = Str::slug($city->name);
        });

        static::updating(function (City $city) {
            $city->slug = Str::slug($city->name);
        });
    }
}
