<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supervision extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'user_id',
        'domaine',
        'contenu',
        'question',
        'methode',
        'reponse',
        'note',
        'commentaire',
        'etablissements',
        'active',
        'type'
    ];

    protected $casts = [
        'note' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function domaines()
    {
        return $this->belongsTo(Domaine::class, 'domaine');
    }

    // Relation avec Questions associées
    public function question()
    {
        return $this->belongsTo(Alluquestion::class, 'question');
    }

    // Relation avec les contenus
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'contenu');
    }

    public function methode()
    {
        return $this->belongsTo(Methode::class, 'methode');
    }
}
