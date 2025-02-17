<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use Illuminate\Http\Request;
use Throwable;

class ContenuController extends Controller
{
    public function saveContenu(Request $request)
    {
        $validated = $request->validate([
            'name_question' => 'required|string|max:255',
        ]);

        try {
            $contenu = Contenu::create([
                'name_question' => $validated['name_question'],
                'type' => $request->has('type') ? $request->type : null,
                'active' => $request->has('active') ? $request->active : true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Contenu créé avec succès',
                'data' => $contenu
            ], 201);

        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function updateContenu(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:contenus,id',
            'name_question' => 'required|string|max:255',
        ]);

        try {
            $contenu = Contenu::findOrFail($validated['id']);

            $contenu->update([
                'name_question' => $validated['name_question'],
                'type' => $request->has('type') ? $request->type : $contenu->type,
                'active' => $request->has('active') ? $request->active : $contenu->active,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Contenu mis à jour avec succès',
                'data' => $contenu
            ], 200);

        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function deleteContenu(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:contenus,id',
        ]);

        try {
            $contenu = Contenu::findOrFail($validated['id']);
            $contenu->delete();

            return response()->json([
                'success' => true,
                'message' => 'Contenu supprimé avec succès'
            ], 200);

        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function getContenu(Request $request)
    {
        try {
            $contenus = Contenu::orderBy('id', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Liste des contenus récupérée avec succès',
                'contenu' => $contenus
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
