<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Probleme extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'probleme',
        'causes',
        'actions',
        'sources',
        'acteurs',
        'ressources',
        'delai',
    ];
}
