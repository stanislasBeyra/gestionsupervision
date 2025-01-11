<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NoteSelect;

class NoteSelectSeeder extends Seeder
{
    public function run()
    {
        $notes = [
            [
                'name' => 'Pas satisfaisant',
                'value' => '0',
                'description' => 'Niveau 0 - Performance non satisfaisante'
            ],
            [
                'name' => 'Besoin d\'amélioration',
                'value' => '1',
                'description' => 'Niveau 1 - Performance nécessitant des améliorations'
            ],
            [
                'name' => 'Satisfaisant',
                'value' => '2',
                'description' => 'Niveau 2 - Performance satisfaisante'
            ]
        ];

        foreach ($notes as $note) {
            NoteSelect::create($note);
        }
    }
}