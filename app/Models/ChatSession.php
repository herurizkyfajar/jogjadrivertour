<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'rating',
        'review',
        'ip_address',
        'chat_history',
    ];

    protected $casts = [
        'rating' => 'integer',
        'chat_history' => 'array',
    ];
}
