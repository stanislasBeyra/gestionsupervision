<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DomaineSelect extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'domaineselects';

    protected $fillable = [
        'name',
        'value',
        'description',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
