<?php

namespace App\Http\Controllers;

use App\Models\Superviser;
use App\Models\Superviseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class SuperviserController extends Controller
{
    // public function getSupervisers()
    // {
    //     try {
    //         $superviseurs = Superviser::orderBy('id', 'desc')->get();
    //         return response()->json(['success' => true, 'superviseur' => $superviseurs]);
    //     } catch (Throwable $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Une erreur est survenue lors de la récupération des supervisers.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function getSupervisers(Request $request)
{
    try {
        $search = $request->input('search', '');


        $superviseurs = Superviser::where('firstname', 'LIKE', "%{$search}%")
            ->orWhere('fonction', 'LIKE', "%{$search}%")
            ->orWhere('service', 'LIKE', "%{$search}%")
            ->orWhere('profession', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orderBy('id', 'desc')
            ->paginate(8);

        return response()->json([
            'success' => true,
            'superviseur' => $superviseurs
        ]);
    } catch (Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la récupération des supervisers.',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function saveSuperviser(Request $request)
    {
        try {

            // firstname dois prendre nom det prenom
            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'fonction' => 'required|string|max:255',
                'service' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255|unique:superviseurs,email',
            ]);

            $superviseur = Superviser::create($validated);

            return response()->json([
                'message' => 'Superviseur enregistré avec succès',
                'data' => $superviseur
            ], 200);
        } catch (Throwable $e) {
            Log::info($e);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la creation des supervisers.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteSuperviser($id)
    {
        try {
            $superviseur = Superviser::findOrFail($id);
            $superviseur->delete();

            return response()->json([
                'success' => true,
                'message' => 'Superviseur supprimé avec succès'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression du superviseur.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function updateSuperviser(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'fonction' => 'required|string|max:255',
                'service' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255|unique:superviseurs,email,' . $id,
            ]);

            $superviseur = Superviser::findOrFail($id);
            $superviseur->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Superviseur mis à jour avec succès',
                'data' => $superviseur
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour du superviseur.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
