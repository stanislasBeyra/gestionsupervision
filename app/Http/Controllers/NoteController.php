<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Throwable;

class NoteController extends Controller
{
    // Récupérer toutes les notes
    public function getNote(Request $request)
    {
        try {
            $query = Note::query();

            // Recherche par nom de note
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where('note_name', 'like', "%$search%");
            }

            $notes = $query->orderBy('id', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Liste des notes récupérée avec succès',
                'data' => $notes
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    // Créer une nouvelle note
    public function saveNote(Request $request)
    {
        $validated = $request->validate([
            'note_name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0|max:20',
        ]);

        try {
            $note = Note::create([
                'note_name' => $validated['note_name'],
                'value' => $validated['value'],
                'active' => $request->has('active') ? $request->active : true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Note créée avec succès',
                'data' => $note
            ], 201);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    // Mettre à jour une note
    public function updateNote(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:notes,id',
            'note_name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0|max:20',
        ]);

        try {
            $note = Note::findOrFail($validated['id']);

            $note->update([
                'note_name' => $validated['note_name'],
                'value' => $validated['value'],
                'active' => $request->has('active') ? $request->active : $note->active,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Note mise à jour avec succès',
                'data' => $note
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    // Supprimer une note
    public function deleteNote(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:notes,id',
        ]);

        try {
            $note = Note::findOrFail($validated['id']);
            $note->delete();

            return response()->json([
                'success' => true,
                'message' => 'Note supprimée avec succès'
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
