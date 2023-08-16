<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Item extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'key',
    ];
}
