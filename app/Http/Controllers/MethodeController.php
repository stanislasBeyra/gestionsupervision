<?php

namespace App\Http\Controllers;

use App\Models\Methode;
use Illuminate\Http\Request;
use Throwable;

class MethodeController extends Controller
{

    public function getMethode(Request $request)
    {
        try {
            $methodes = Methode::all();

            return response()->json([
                'success' => true,
                'message' => 'Liste des méthodes récupérée avec succès',
                'data' => $methodes
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }


    public function saveMethode(Request $request)
    {
        $validated = $request->validate([
            'methode_name' => 'required|string|max:255',
        ]);

        try {
            $methode = Methode::create([
                'methode_name' => $validated['methode_name'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Méthode créée avec succès',
                'data' => $methode
            ], 201);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }


    public function updateMethode(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:methode,id',
            'methode_name' => 'required|string|max:255',
        ]);

        try {
            $methode = Methode::findOrFail($validated['id']);

            $methode->update([
                'methode_name' => $validated['methode_name'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Méthode mise à jour avec succès',
                'data' => $methode
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function deleteMethode(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:methode,id',
        ]);

        try {
            $methode = Methode::findOrFail($validated['id']);
            $methode->delete();

            return response()->json([
                'success' => true,
                'message' => 'Méthode supprimée avec succès'
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
