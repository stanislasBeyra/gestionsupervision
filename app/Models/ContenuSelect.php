<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContenuSelect extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contenuselects';
    protected $fillable = [
        'domaineselect_id',
        'name',
        'value',
        'description',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
