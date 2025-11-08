<?php

namespace App\Http\Controllers;

use App\Models\Probleme;
use Illuminate\Support\Facades\Log;
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

        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            Log::error('Utilisateur non authentifié');
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non authentifié'
            ], 401);
        }

        $userId = auth()->id();
        Log::info('User ID:', ['user_id' => $userId]);

        $query = Probleme::query();
        $perPage = $request->input('per_page', 10); // Nombre d'éléments par page, valeur par défaut = 10

        // Appliquer les conditions de recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('probleme', 'LIKE', "%{$search}%")
                    ->orWhere('causes', 'LIKE', "%{$search}%")
                    ->orWhere('actions', 'LIKE', "%{$search}%")
                    ->orWhere('sources', 'LIKE', "%{$search}%")
                    ->orWhere('acteurs', 'LIKE', "%{$search}%")
                    ->orWhere('ressources', 'LIKE', "%{$search}%")
                    ->orWhere('delai', 'like', "%$search%");
            });
        }

        // Filtrer par user_id
        $query->where('user_id', $userId);

        // Exécuter la requête
        $probleme = $query->orderBy('id', 'desc')->paginate(5);

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

            $validated['user_id'] = auth()->user()->id;
            $probleme = Probleme::create($validated);
            Log::info('Nouveau problème ajouté', ['probleme' => $probleme]);

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

    public function deleteProbleme($id)
    {
        try {
            $probleme = Probleme::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();
            
            $probleme->delete();

            return response()->json([
                'success' => true,
                'message' => 'Problème supprimé avec succès'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Problème introuvable ou vous n\'avez pas les droits pour le supprimer.'
            ], 404);
        } catch (Throwable $e) {
            Log::error('Erreur lors de la suppression du problème:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression du problème.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
