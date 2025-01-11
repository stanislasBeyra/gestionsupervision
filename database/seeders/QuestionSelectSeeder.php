<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionSelect;

class QuestionSelectSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            [
                'name' => 'Effectif d\'agents disponibles dans la structure par catégorie et profil? (Medecins/Chirurgiens/IDE/SF/AS)',
                'value' => 'effectif_agents',
                'description' => 'Recensement du personnel médical par catégorie'
            ],
            [
                'name' => 'Avez-vous été formé à la prise en charge des MTN?',
                'value' => 'formation_mtn',
                'description' => 'Formation en prise en charge des MTN'
            ],
            [
                'name' => 'Quels sont les MTN pour lesquelles vous avez été formé?',
                'value' => 'mtn_formation',
                'description' => 'Types de MTN couverts par la formation'
            ],
            [
                'name' => 'Quand avez-vous été formé?',
                'value' => 'date_formation',
                'description' => 'Date de la formation'
            ],
            [
                'name' => 'Avez-vous reçu une formation dans le cadre de la lutte anti vectorielle contre les MTN ?',
                'value' => 'formation_lutte_vectorielle',
                'description' => 'Formation en lutte anti-vectorielle'
            ],
            [
                'name' => 'Combien de médecins ont été formés pour les MTN dans votre établissement?',
                'value' => 'nombre_medecins_formes',
                'description' => 'Effectif des médecins formés'
            ],
            [
                'name' => 'Existe-t-il des chirurgiens certifiés dans la prise en charge des hydrocèles?',
                'value' => 'chirurgiens_hydrocele',
                'description' => 'Certification des chirurgiens pour hydrocèles'
            ],
            [
                'name' => 'Existe-t-il des agents formés à la prise en charge des trichiasis trachomateux (TT)?',
                'value' => 'agents_trichiasis',
                'description' => 'Formation pour trichiasis trachomateux'
            ],
            [
                'name' => 'Existe-t-il des agents formés à la gestion des plaies et des cicatrices ?',
                'value' => 'agents_plaies',
                'description' => 'Formation en gestion des plaies'
            ],
            [
                'name' => 'Existe-t-il un circuit d\'orientation pour les patients?',
                'value' => 'circuit_orientation',
                'description' => 'Système d\'orientation des patients'
            ],
            [
                'name' => 'Existe-t-il une salle d\'accueil pour les patients?',
                'value' => 'salle_accueil',
                'description' => 'Disponibilité salle d\'accueil'
            ],
            [
                'name' => 'Existe-t-il un point d\'eau potable accessible aux patients?',
                'value' => 'point_eau_patients',
                'description' => 'Accès à l\'eau potable'
            ],
            [
                'name' => 'Existe-t-il des toilettes/latrines fonctionnelles pour les patients?',
                'value' => 'toilettes_patients',
                'description' => 'Disponibilité sanitaires'
            ],
            [
                'name' => 'Existe-t-il un équipement pour la gestion des déchets biomédicaux?',
                'value' => 'equipement_dechets',
                'description' => 'Gestion déchets médicaux'
            ],
            [
                'name' => 'Disposez-vous d\'un kit informatique fonctionnel?',
                'value' => 'kit_informatique',
                'description' => 'Équipement informatique disponible'
            ]
        ];

        foreach ($questions as $question) {
            QuestionSelect::create($question);
        }
    }
}