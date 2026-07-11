<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'ip', 'url', 'page', 'method', 'user_agent',
        'referrer', 'country', 'device', 'browser', 'is_unique', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'is_unique' => 'boolean',
    ];
}
