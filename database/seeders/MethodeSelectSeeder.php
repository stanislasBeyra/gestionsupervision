<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MethodeSelect;

class MethodeSelectSeeder extends Seeder
{
    public function run()
    {
        $methodes = [
            [
                'name' => 'Entretien',
                'value' => 'entretien',
                'description' => 'Discussion directe avec le personnel ou les responsables'
            ],
            [
                'name' => 'Observation',
                'value' => 'observation',
                'description' => 'Observation directe des installations et pratiques'
            ],
            [
                'name' => 'Revue documentaire',
                'value' => 'revue_documentaire',
                'description' => 'Analyse des documents et registres'
            ],
            [
                'name' => 'Vérification',
                'value' => 'verification',
                'description' => 'Vérification physique des équipements et procédures'
            ],
            [
                'name' => 'Entretien / Revue documentaire',
                'value' => 'entretien_revue_documentaire',
                'description' => 'Combinaison d\'entretien et d\'analyse documentaire'
            ],
            [
                'name' => 'Entretien et observation',
                'value' => 'entretien_observation',
                'description' => 'Combinaison d\'entretien et d\'observation directe'
            ],
            [
                'name' => 'Entretien/Vérification',
                'value' => 'entretien_verification',
                'description' => 'Combinaison d\'entretien et de vérification'
            ],
            [
                'name' => 'Observation/Vérification',
                'value' => 'observation_verification',
                'description' => 'Combinaison d\'observation et de vérification'
            ],
            [
                'name' => 'Entretien, revue documentaire, vérification, observation',
                'value' => 'methode_complete',
                'description' => 'Approche complète utilisant toutes les méthodes'
            ],
            [
                'name' => 'Entretien/Observation/Vérification',
                'value' => 'entretien_observation_verification',
                'description' => 'Triple approche combinant entretien, observation et vérification'
            ]
        ];

        foreach ($methodes as $methode) {
            MethodeSelect::create($methode);
        }
    }
}