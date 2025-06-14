<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etablissement extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        //ajout de user_id pour la relation avec l'utilisateur
        'user_id',
        'direction_regionale',
        'district_sanitaire',
        'etablissement_sanitaire',
        'categorie_etablissement',
        'code_etablissement',
        'periode',
        'periodicite',
        'date_debut',
        'date_fin',
        'responsable',
        'telephone',
        'email',
    ];


}
