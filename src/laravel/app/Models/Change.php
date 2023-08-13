<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $fillable = [
        'event_type',
        'model',
        'model_id',
        'changes',
    ];

    protected $casts = [
        'changes' => 'array',
    ];
}
