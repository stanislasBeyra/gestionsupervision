<?php

namespace App\Http\Controllers;

use App\Models\Supervision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class SupervisionsController extends Controller
{

    public function getSupervision(Request $request)
    {
        try {
            $query = Supervision::query();

            // Si un mot-clé de recherche est passé dans la requête
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('reponse', 'like', "%$search%")
                        ->orWhere('commentaire', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%");
                });
            }

            // Applique un tri par ID décroissant
            $supervisions = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'message' => 'Liste des supervisions récupérée avec succès',
                'data' => $supervisions
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function getEnvironnementElement(Request $request)
    {
        try {
            $query = Supervision::query();
            $query->with(['domaines','questions','continues','methodes']);
            // Filtrer par type = 1
            $query->where('type', 1);

            // Si un mot-clé de recherche est passé dans la requête
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('reponse', 'like', "%$search%")
                        ->orWhere('commentaire', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%");
                });
            }

            // Applique un tri par ID décroissant
            $supervisions = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'message' => 'Liste des supervisions récupérée avec succès',
                'data' => $supervisions
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }


    public function getCompetanceElement(Request $request)
    {
        try {
            $query = Supervision::query();

            $query->with(['domaines','questions','continues','methodes']);

            // Filtrer par type = 2
            $query->where('type', 2);

            // Si un mot-clé de recherche est passé dans la requête
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('domaine', 'like', "%$search%")
                        ->orWhere('contenu', 'like', "%$search%")
                        ->orWhere('question', 'like', "%$search%")
                        ->orWhere('methode', 'like', "%$search%")
                        ->orWhere('reponse', 'like', "%$search%")
                        ->orWhere('commentaire', 'like', "%$search%")
                        ->orWhere('etablissements', 'like', "%$search%");
                });
            }

            // Applique un tri par ID décroissant
            $supervisions = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'message' => 'Liste des supervisions récupérée avec succès',
                'data' => $supervisions
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }




    public function saveSupervision(Request $request)
    {
        $validated = $request->validate([
            'domaine' => 'required|string|max:255',
            'contenu' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'methode' => 'required|string|max:255',
            'reponse' => 'nullable|string|max:255',
            'note' => 'required|numeric',
            'commentaire' => 'nullable|string',
            'etablissements' => 'required|string|max:255',
            'type' => 'required|integer'
        ]);



        try {
            $supervision = Supervision::create([
                'domaine' => $validated['domaine'],
                'contenu' => $validated['contenu'],
                'question' => $validated['question'],
                'methode' => $validated['methode'],
                'reponse' => $validated['reponse'] ?? null,
                'note' => $validated['note'],
                'type' => $validated['type'],
                'commentaire' => $validated['commentaire'] ?? null,
                'etablissements' => $validated['etablissements'],
                'active' => $request->has('active') ? $request->active : true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supervision créée avec succès',
                'data' => $supervision
            ], 201);
        } catch (\Throwable $t) {
            Log::error('Erreur lors de la création de la supervision : ' . $t->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }



    public function updateSupervision(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:supervisions,id',
            'domaine' => 'required|string|max:255',
            'contenu' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'methode' => 'required|string|max:255',
            'reponse' => 'required|string|max:255',
            'note' => 'required|numeric',
            'commentaire' => 'nullable|string',
            'etablissements' => 'required|string|max:255',
        ]);

        try {
            $supervision = Supervision::findOrFail($validated['id']);

            $supervision->update([
                'domaine' => $validated['domaine'],
                'contenu' => $validated['contenu'],
                'question' => $validated['question'],
                'methode' => $validated['methode'],
                'reponse' => $validated['reponse'],
                'note' => $validated['note'],
                'commentaire' => $validated['commentaire'] ?? $supervision->commentaire,
                'etablissements' => $validated['etablissements'],
                'active' => $request->has('active') ? $request->active : $supervision->active,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supervision mise à jour avec succès',
                'data' => $supervision
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function deleteSupervision(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:supervisions,id',
        ]);

        try {
            $supervision = Supervision::findOrFail($validated['id']);
            $supervision->delete();

            return response()->json([
                'success' => true,
                'message' => 'Supervision supprimée avec succès'
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }
}
