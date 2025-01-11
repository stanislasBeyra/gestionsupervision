<?php

namespace Database\Seeders;

use App\Models\ContenuSelect;
use Illuminate\Database\Seeder;

class ContenuSelectSeeder extends Seeder
{
    public function run()
    {
        $contenus = [
            [
                'name' => 'Nombre d\'agent par catégorie',
                'value' => 'nombre_agent_categorie',
                'description' => 'Effectif d\'agents disponibles dans la structure par catégorie et profil'
            ],
            [
                'name' => 'Ancienneté',
                'value' => 'anciennete',
                'description' => 'Ancienneté du personnel'
            ],
            [
                'name' => 'Rôle attribué (prestation)',
                'value' => 'role_attribue',
                'description' => 'Description du rôle dans la lutte contre les MTN'
            ],
            [
                'name' => 'Besoins en formation',
                'value' => 'besoins_formation',
                'description' => 'Identification des besoins en formation'
            ],
            [
                'name' => 'Environnement/Signalisation/Espaces visiteurs',
                'value' => 'environnement_signalisation',
                'description' => 'Présentation générale, entretien, orientation des patients'
            ],
            [
                'name' => 'Salle de consultation',
                'value' => 'salle_consultation',
                'description' => 'Salle de consultation avec commodités (hygiène, intimité, confidentialité)'
            ],
            [
                'name' => 'Salle d\'hospitalisation',
                'value' => 'salle_hospitalisation',
                'description' => 'Salle d\'hospitalisation pour les MTN'
            ],
            [
                'name' => 'Bloc opératoire',
                'value' => 'bloc_operatoire',
                'description' => 'Bloc opératoire avec plateau technique adapté aux soins MTN'
            ],
            [
                'name' => 'Laboratoire',
                'value' => 'laboratoire',
                'description' => 'Service de laboratoire'
            ],
            [
                'name' => 'Imagerie médicale',
                'value' => 'imagerie_medicale',
                'description' => 'Service d\'imagerie médicale'
            ],
            [
                'name' => 'Wash',
                'value' => 'wash',
                'description' => 'Source d\'eau potable, Toilettes, douche, hygiène'
            ],
            [
                'name' => 'Électricité et alternatives',
                'value' => 'electricite',
                'description' => 'Sources d\'alimentation électrique et alternatives'
            ],
            [
                'name' => 'Équipements de bureau',
                'value' => 'equipements_bureau',
                'description' => 'Kit informatique et matériel de bureau'
            ],
            [
                'name' => 'Matériels roulants',
                'value' => 'materiels_roulants',
                'description' => 'Moto, véhicule pour activités MTN'
            ],
            [
                'name' => 'Matériels de mobilité',
                'value' => 'materiels_mobilite',
                'description' => 'Matériel pour personnes handicapées (fauteuil roulant, brancard)'
            ]
        ];

        foreach ($contenus as $contenu) {
            ContenuSelect::create($contenu);
        }
    }
}