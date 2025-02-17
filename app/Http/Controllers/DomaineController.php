<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Throwable;

class DomaineController extends Controller
{

    public function getDomaine()
    {
        try {
            $domaines = Domaine::orderBy('id', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Liste des domaines récupérée avec succès',
                'domaine' => $domaines
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function saveDomaine(Request $request)
    {
        $validated = $request->validate([
            'name_question' => 'required|string|max:255',
        ]);

        try {
            $domaine = Domaine::create([
                'name_question' => $validated['name_question'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Domaine créé avec succès',
                'data' => $domaine
            ], 201);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }



    public function updateDomaine(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:domaines,id',
            'name_question' => 'required|string|max:255',
        ]);

        try {
            $domaine = Domaine::findOrFail($validated['id']);

            $domaine->update([
                'name_question' => $validated['name_question'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Domaine mis à jour avec succès',
                'data' => $domaine
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function deleteDomaine(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:domaines,id',
        ]);

        try {
            $domaine = Domaine::findOrFail($validated['id']);
            $domaine->delete();

            return response()->json([
                'success' => true,
                'message' => 'Domaine supprimé avec succès'
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
