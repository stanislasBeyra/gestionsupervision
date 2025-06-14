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
        return $this->belongsTo(Domaine::class,'domaine');
    }



    // Relation avec Questions associées
    public function questions()
    {
        return $this->hasMany(Alluquestion::class,'id','question');
    }

    // Relation avec les commentaires
    public function continues()
    {
        return $this->hasMany(Contenu::class,'id','contenu');
    }

    public function methodes()
    {
        return $this->hasMany(Methode::class,'id','methode');
    }
}
