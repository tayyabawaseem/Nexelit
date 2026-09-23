<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFont extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'variants',
        'type',
        'file_path',
    ];

    protected $casts = [
        'variants' => 'array',
    ];
}
