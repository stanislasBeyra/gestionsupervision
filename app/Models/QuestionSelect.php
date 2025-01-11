<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionSelect extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'questionselects';
    
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
