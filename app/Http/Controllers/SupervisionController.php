<?php

namespace App\Http\Controllers;

use App\Models\Supervision;
use Illuminate\Http\Request;

class SupervisionController extends Controller
{
    //

    public function getallsupervision()
    {
        $supervisions = Supervision::where('active', true)
        ->orderBy('id','desc')
       -> get();
        return response()->json($supervisions);
    }

    public function AddSupervision(Request $request)
    {
        try {
            $validation = $request->validate([
                'domaine' => 'required|string',
                'domaine_text' => 'required|string',
                'contenu' => 'required|string',
                'contenu_text' => 'required|string',
                'question' => 'required|string',
                'question_text' => 'required|string',
                'methode' => 'required|string',
                'methode_text' => 'required|string',
                'reponse' => 'required|string',
                'note' => 'required|string',
                'note_text' => 'required|string',
                'commentaire' => 'required|string',
                'etablissements' => 'required|array'
            ]);

            $supervision = Supervision::create($validation);

            return response()->json([
                'message' => 'Données enregistrées avec succès',
                'supervision' => $supervision
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de l\'enregistrement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function DeleteSupervision($id)
    {
        try {
            $supervision = Supervision::findOrFail($id);
            $supervision->delete();

            return response()->json([
                'message' => 'Données supprimées avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la suppression',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
