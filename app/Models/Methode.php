<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Methode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'methode_name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
