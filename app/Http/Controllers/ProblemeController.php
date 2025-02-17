<?php

namespace App\Http\Controllers;

use App\Models\Probleme;
use Illuminate\Http\Request;
use Throwable;

class ProblemeController extends Controller
{
    // Récupérer tous les problèmes
    // public function getProbleme()
    // {
    //     try {

    //         $probleme = Probleme::orderBy('id', 'desc')->get();
    //         return response()->json(['success' => true, 'problemes' => $probleme]);
    //     } catch (Throwable $t) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Une erreur est survenue',
    //             'error' => $t->getMessage()
    //         ], 500);
    //     }
    // }

    public function getProbleme(Request $request)
{
    try {
        // Récupération des paramètres de recherche et de pagination
        $search = $request->input('search', ''); // Le terme de recherche
        $perPage = $request->input('per_page', 10); // Nombre d'éléments par page, valeur par défaut = 10

        // Recherche des problèmes avec le terme 'search' sur les colonnes pertinentes
        $probleme = Probleme::when($search, function ($query, $search) {
            return $query->where('probleme', 'like', "%$search%")
                         ->orWhere('causes', 'like', "%$search%")
                         ->orWhere('actions', 'like', "%$search%")
                         ->orWhere('sources', 'like', "%$search%")
                         ->orWhere('acteurs', 'like', "%$search%")
                         ->orWhere('ressources', 'like', "%$search%")
                         ->orWhere('delai', 'like', "%$search%");
        })
        ->orderBy('id', 'desc') // Trie par ID en ordre décroissant
        ->paginate(5); // Pagination avec le nombre d'éléments par page

        // Retourner les résultats paginés
        return response()->json([
            'success' => true,
            'problemes' => $probleme
        ]);
    } catch (Throwable $t) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue',
            'error' => $t->getMessage()
        ], 500);
    }
}


    // Enregistrer un nouveau problème
    public function saveProbleme(Request $request)
    {
        try {
            $validated = $request->validate([
                'probleme' => 'required|string',
                'causes' => 'required|string',
                'actions' => 'required|string',
                'sources' => 'required|string',
                'acteurs' => 'required|string',
                'ressources' => 'required|string',
                'delai' => 'required|string',
            ]); 

            $probleme = Probleme::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Problème ajouté avec succès',
                'data' => $probleme,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
