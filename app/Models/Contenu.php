<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_contenu',
        'type',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
