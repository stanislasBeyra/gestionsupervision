<?php

namespace App\Http\Controllers;

use App\Models\Synthese;
use Illuminate\Http\Request;
use Throwable;

class SyntheseController extends Controller
{

    public function getallsyntese(Request $request)
    {
        try {
            $query = Synthese::query();

            // Ajoute une recherche globale sur le domaine
            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where('domaine', 'like', '%' . $search . '%');
            }

            $syntheses = $query->orderBy('id', 'desc')->get();

            return response()->json([
                'success' => true,
                'synteste' => $syntheses
            ]);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }




    public function saveSynthese(Request $request)
    {
        try {
            $validated = $request->validate([
                'domaine' => 'required|string|max:255',
                'points_obtenus' => 'required|numeric',
            ]);


            // Création et sauvegarde de la synthèse
            $synthese = Synthese::create($validated);

            return response()->json([
                'message' => 'Synthèse enregistrée avec succès',
                'data' => $synthese
            ], 201);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }
}
