<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class EtablissementController extends Controller
{


    public function statistiqueselements()
    {
        try {
            $etablissements = Etablissement::count();
            return response()->json([
                'success' => true,
                'data' => $etablissements
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getEtablissements(Request $request)
    {
        try {
            $query = Etablissement::query();
            // ajout were pour la recuperation des etablissement
            // de l'utilisateur connecter avec where user_id=auth()->user()->id
            $query->where('user_id', auth()->user()->id);
            // Récupération du mot-clé de recherche depuis la requête
            $search = $request->input('search');

            if ($search) {
                $query->where('direction_regionale', 'LIKE', "%{$search}%")
                    ->orWhere('district_sanitaire', 'LIKE', "%{$search}%")
                    ->orWhere('etablissement_sanitaire', 'LIKE', "%{$search}%")
                    ->orWhere('categorie_etablissement', 'LIKE', "%{$search}%")
                    ->orWhere('code_etablissement', 'LIKE', "%{$search}%")
                    ->orWhere('responsable', 'LIKE', "%{$search}%")
                    ->orWhere('telephone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            }

            $etablissements = $query->orderBy('id', 'desc')->paginate(8);

            return response()->json([
                'success' => true,
                'data' => $etablissements
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function saveEtablissement(Request $request)
    {
        try {
            $validated = $request->validate([
                'direction_regionale' => 'required|string|max:255',
                'district_sanitaire' => 'required|string|max:255',
                'etablissement_sanitaire' => 'required|string|max:255',
                'categorie_etablissement' => 'required|string',
                'code_etablissement' => 'required|string|unique:etablissements,code_etablissement',
                'periode' => 'required|string|max:255',
                'periodicite' => 'required|string|max:255',
                'date_debut' => 'required|',
                'date_fin' => 'required|',
                'responsable' => 'required|string|max:255',
                'telephone' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);
            //  Log::info('User ID:', ['user_id' => auth()->user()]);

            // ajout de user_id pour la relation avec l'utilisateur
            $validated['user_id'] = auth()->user()->id;
            $etablissement = Etablissement::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Établissement enregistré avec succès',
                'data' => $etablissement
            ], 201);
        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de l\'enregistrement de l\'établissement.', ['errors' => $e->errors()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de l\'enregistrement de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'enregistrement de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEtablissement($id)
    {
        try {
            $etablissement = Etablissement::findOrFail($id);
            $etablissement->delete();

            return response()->json([
                'success' => true,
                'message' => 'Établissement supprimé avec succès'
            ], 200);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la suppression de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function updateEtablissement(Request $request, $id)
    {
        try {
            $etablissement = Etablissement::findOrFail($id);

            $validated = $request->validate([
                'direction_regionale' => 'required|string|max:255',
                'district_sanitaire' => 'required|string|max:255',
                'etablissement_sanitaire' => 'required|string|max:255',
                'categorie_etablissement' => 'required|string',
                'code_etablissement' => 'required|string|unique:etablissements,code_etablissement,' . $etablissement->id,
                'periode' => 'required|string|max:255',
                'periodicite' => 'required|string|max:255',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
                'responsable' => 'required|string|max:255',
                'telephone' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            // Mise à jour des données de l'établissement
            $etablissement->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Établissement mis à jour avec succès',
                'data' => $etablissement
            ], 200);
        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de la mise à jour de l\'établissement.', ['errors' => $e->errors()]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la mise à jour de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getEtablissementById($id)
    {
        try {
            $etablissement = Etablissement::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $etablissement
            ], 200);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la récupération de l\'établissement.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getEtablissementsByUserId($userId)
    {
        try {
            $etablissements = Etablissement::where('user_id', $userId)->get();

            return response()->json([
                'success' => true,
                'data' => $etablissements
            ], 200);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors de la récupération des établissements par utilisateur.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function countEtablissement()
    {
        try {
            $count = Etablissement::count();

            Log::info('Nombre d\'établissements:', ['count' => $count]);
            return response()->json([
                'success' => true,
                'data' => $count
            ], 200);
        } catch (Throwable $e) {
            Log::error('Une erreur est survenue lors du comptage des établissements.', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du comptage des établissements.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
