<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class EtablissementController extends Controller
{

    // public function getEtablissements()
    // {
    //     try {
    //         $etablissements = Etablissement::orderBy('id', 'desc')->get();

    //         return response()->json([
    //             'success' => true,
    //             'data' => $etablissements
    //         ], 200);
    //     } catch (Throwable $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Une erreur est survenue lors de la récupération des établissements.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function getEtablissements(Request $request)
{
    try {
        $query = Etablissement::query();

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

            $etablissement = Etablissement::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Établissement enregistré avec succès',
                'data' => $etablissement
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'enregistrement de l\'établissement.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
