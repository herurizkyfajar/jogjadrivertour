<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(BlogComment::class)->where('status', 'approved');
    }

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'author_name',
        'author_avatar',
        'category',
        'view_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
