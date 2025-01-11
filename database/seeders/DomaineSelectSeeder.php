<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DomaineSelect;

class DomaineSelectSeeder extends Seeder
{
    public function run()
    {
        $domaines = [
            [
                'name' => 'Ressources humaines formées à la lutte contre les MTN',
                'value' => 'ressources_humaines_mtn',
                'description' => 'Formation et gestion des ressources humaines dans la lutte contre les MTN'
            ],
            [
                'name' => 'Infrastructures',
                'value' => 'infrastructures',
                'description' => 'Mobiliers, immobiliers, plateaux techniques, matériels informatiques, roulants, logistique'
            ],
            [
                'name' => 'Communication pour le changement de comportement / IEC',
                'value' => 'communication_iec',
                'description' => 'Communication et sensibilisation'
            ],
            [
                'name' => 'Prise en charge des morbidités',
                'value' => 'prise_en_charge',
                'description' => 'Gestion et suivi des cas de morbidité'
            ],
            [
                'name' => 'Lutte anti vectorielle',
                'value' => 'lutte_vectorielle',
                'description' => 'Actions de lutte contre les vecteurs'
            ],
            [
                'name' => 'Gestion des médicaments',
                'value' => 'gestion_medicaments',
                'description' => 'Gestion des stocks et distribution des médicaments'
            ],
            [
                'name' => 'Gestion des déchets',
                'value' => 'gestion_dechets',
                'description' => 'Traitement et gestion des déchets médicaux'
            ],
            [
                'name' => 'Confirmation des cas',
                'value' => 'confirmation_cas',
                'description' => 'Processus de confirmation des cas détectés'
            ],
            [
                'name' => 'Soutien psychologique',
                'value' => 'soutien_psychologique',
                'description' => 'Support et accompagnement psychologique'
            ],
            [
                'name' => 'Réinsertion socio-économique',
                'value' => 'reinsertion',
                'description' => 'Programmes de réinsertion sociale et économique'
            ],
            [
                'name' => 'Lutte contre la stigmatisation',
                'value' => 'lutte_stigmatisation',
                'description' => 'Promotion de l\'inclusion et lutte contre la stigmatisation'
            ],
            [
                'name' => 'Supervision des Agents de santé communautaire',
                'value' => 'supervision_asc',
                'description' => 'Suivi et encadrement des agents de santé'
            ],
            [
                'name' => 'Surveillance',
                'value' => 'surveillance',
                'description' => 'Surveillance épidémiologique et suivi'
            ],
            [
                'name' => 'Rapportage',
                'value' => 'rapportage',
                'description' => 'Gestion des rapports et documentation'
            ],
            [
                'name' => 'Encadrement de stagiaires',
                'value' => 'encadrement_stagiaires',
                'description' => 'Formation et suivi des stagiaires'
            ],
        ];

        foreach ($domaines as $domaine) {
            DomaineSelect::create($domaine);
        }
    }
}