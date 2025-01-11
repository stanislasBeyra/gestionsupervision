<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supervision extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'domaine',
        'domaine_text',
        'contenu',
        'contenu_text',
        'question',
        'question_text',
        'methode',
        'methode_text',
        'reponse',
        'note',
        'note_text',
        'commentaire',
        'etablissements',
        'active'
    ];

    protected $casts = [
        'etablissements' => 'array',
        'active' => 'boolean'
    ];
}
