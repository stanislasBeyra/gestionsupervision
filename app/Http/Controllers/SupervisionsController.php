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

            $query->where('user_id', $userId);
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

            $query->where('user_id', $userId);
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
            // Vérifier si l'utilisateur est authentifié// Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            Log::error('Utilisateur non authentifié');
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non authentifié'
            ], 401);
        }

        $userId = auth()->id();
        Log::info('User ID:', ['user_id' => $userId]);

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

            $query->where('user_id', $userId);
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
                'user_id' => auth()->id(),
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
            $supervision = Supervision::where('id', $validated['id'])
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

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
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supervision introuvable ou vous n\'avez pas les droits pour la modifier.'
            ], 404);
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
            $supervision = Supervision::where('id', $validated['id'])
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();
            
            $supervision->delete();

            return response()->json([
                'success' => true,
                'message' => 'Supervision supprimée avec succès'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supervision introuvable ou vous n\'avez pas les droits pour la supprimer.'
            ], 404);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }
    public function getsynthese()
{
    try {
        $userId = auth()->id();
        
        // Récupération des données avec les relations, filtrées par user_id
        $data = Supervision::where('user_id', $userId)
            ->with(['domaines:id,name_domaine'])
            ->select('points_disponible', 'note', 'domaine')
            ->get();

        // Grouper les données par domaine
        $grouped = $data->groupBy(function ($item) {
            return $item->domaines->name_domaine ?? 'Non défini';
        });

        // Calculer les synthèses par domaine
        $synthese = $grouped->map(function ($items, $domaine) {
            $points_disponibles = $items->sum('points_disponible');
            $points_obtenus = $items->sum('note');

            return [
                'domaine' => $domaine,
                'points_disponibles' => (float) $points_disponibles,
                'points_obtenus' => (float) $points_obtenus,
                'percentage' => $points_disponibles > 0 ?
                    round(($points_obtenus / $points_disponibles) * 100, 2) : 0
            ];
        })->values();

        // Calculer le total
        $total_points_disponibles = $synthese->sum('points_disponibles');
        $total_points_obtenus = $synthese->sum('points_obtenus');

        // Ajouter le total à la synthèse
        $synthese->push([
            'domaine' => 'TOTAL',
            'points_disponibles' => (float) $total_points_disponibles,
            'points_obtenus' => (float) $total_points_obtenus,
            'percentage' => $total_points_disponibles > 0 ?
                round(($total_points_obtenus / $total_points_disponibles) * 100, 2) : 0
        ]);

        return response()->json([
            'success' => true,
            'synthese' => $synthese
        ]);

    } catch (Throwable $t) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue',
            'error' => $t->getMessage()
        ], 500);
    }
}


    public function getsyntheses()
{
    try {
        $query = Supervision::query();

        // Récupérer les domaines uniques avec leurs relations
        $domaines = $query->with('domaines')->distinct()->pluck('domaine');

        // Initialiser le tableau de résultats
        $synthese = [];

        foreach ($domaines as $domaine) {
            // Récupérer les supervisions pour le domaine actuel
            $supervisions = $query->where('domaine', $domaine)
                                ->with('domaines')
                                ->get();

            if ($supervisions->isNotEmpty()) {
                // Calculer les points disponibles et obtenus pour le domaine
                $points_disponibles = $supervisions->sum('points_disponibles');
                $points_obtenus = $supervisions->sum('points_obtenus');

                // Calculer le pourcentage pour le domaine avec vérification de division par zéro
                $percentage = $points_disponibles > 0 ? ($points_obtenus / $points_disponibles) * 100 : 0;

                // Récupérer le nom du domaine depuis la relation
                $nomDomaine = $supervisions->first()->domaines ?
                             $supervisions->first()->domaines->name_domaine :
                             $domaine;

                // Ajouter les résultats au tableau de synthèse
                $synthese[] = [
                    'domaine' => $nomDomaine,
                    'points_disponibles' => $points_disponibles,
                    'points_obtenus' => $points_obtenus,
                    'percentage' => round($percentage, 2)
                ];
            }
        }

        if (!empty($synthese)) {
            // Calculer le total des points disponibles et obtenus
            $total_points_disponibles = array_sum(array_column($synthese, 'points_disponibles'));
            $total_points_obtenus = array_sum(array_column($synthese, 'points_obtenus'));

            // Calculer le pourcentage total avec vérification de division par zéro
            $total_percentage = $total_points_disponibles > 0 ?
                              ($total_points_obtenus / $total_points_disponibles) * 100 :
                              0;

            // Ajouter les totaux à la synthèse
            $synthese[] = [
                'domaine' => 'TOTAL',
                'points_disponibles' => $total_points_disponibles,
                'points_obtenus' => $total_points_obtenus,
                'percentage' => round($total_percentage, 2)
            ];
        }

        return response()->json([
            'success' => true,
            'synthese' => $synthese
        ]);

    } catch (Throwable $t) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue',
            'error' => $t->getMessage()
        ], 500);
    }
}
}
