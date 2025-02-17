<?php

namespace App\Http\Controllers;

use App\Models\Alluquestion;
use Illuminate\Http\Request;
use Throwable;

class AllQuestionController extends Controller
{

    public function getquestion()
    {
        try {
            $allquestions = Alluquestion::orderBy('id', 'desc')->get();
            return response()->json(['success' => true, 'questions' => $allquestions]);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => "Une erreur est survenue.",
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function SaveQuestion(Request $request)
    {
        $validated = $request->validate([
            'name_question' => 'required|string|max:255',
            'type' => 'required|integer',
        ]);

        try {
            $question = Alluquestion::create([
                'name_question' => $validated['name_question'],
                'type' => $validated['type'],
                'active' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Question enregistrée avec succès',
                'data' => $question
            ], 201);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function updateQuestion(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:alluquestions,id',
            'name_question' => 'required|string|max:255',
            'type' => 'required|integer',
            'active' => 'nullable|boolean',
        ]);

        try {
            $question = Alluquestion::findOrFail($validated['id']);

            $question->update([
                'name_question' => $validated['name_question'],
                'type' => $validated['type'],
                'active' => $request->has('active') ? $request->active : $question->active,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Question mise à jour avec succès',
                'data' => $question
            ], 200);
        } catch (Throwable $t) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue',
                'error' => $t->getMessage()
            ], 500);
        }
    }

    public function deleteQuestion(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:alluquestions,id',
        ]);

        try {
            $question = Alluquestion::findOrFail($validated['id']);
            $question->delete();

            return response()->json([
                'success' => true,
                'message' => 'Question supprimée avec succès'
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
