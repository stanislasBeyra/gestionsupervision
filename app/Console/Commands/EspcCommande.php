<?php

namespace App\Console\Commands;

use App\Models\Note;
use Illuminate\Console\Command;

class EspcCommande extends Command
{
    protected $signature = 'app:espc-commande';
    protected $description = 'Insertion des notes pour les établissements sanitaires';

    public function handle()
    {
        // Les valeurs à insérer dans la table
        $notes = [
            ['note_name' => 'Pas satisfaisant', 'value' => 0, 'active' => true],
            ['note_name' => 'Besoin d\'amélioration', 'value' => 1, 'active' => true],
            ['note_name' => 'Satisfaisant', 'value' => 2, 'active' => true],
        ];

        // Insertion dans la base de données
        foreach ($notes as $note) {
            Note::create($note);
        }

        $this->info('Les notes ont été insérées avec succès!');
    }
}
