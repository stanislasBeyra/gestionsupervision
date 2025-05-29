<?php

namespace App\Http\Controllers;

use App\Models\Superviseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class SuperviseurController extends Controller
{


    // public function getSuperviseurs()
    // {
    //     try {
    //         $superviseurs = Superviseur::orderBy('id', 'desc')->get();
    //         return response()->json(['success' => true, 'superviseur' => $superviseurs]);
    //     } catch (Throwable $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Une erreur est survenue lors de la récupération des superviseurs.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function getSuperviseurs(Request $request)
{
    try {
        $search = $request->input('search', '');


        $superviseurs = Superviseur::where('firstname', 'LIKE', "%{$search}%")
            ->orWhere('fonction', 'LIKE', "%{$search}%")
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


    public function saveSuperviseur(Request $request)
    {
        try {
            // $validated = $request->validate([
            //     'firstname' => 'required|string|max:255',
            //     'lastname' => 'required|string|max:255',
            //     'fonction' => 'required|string|max:255',
            //     'phone' => 'required|string|max:15',
            //     'email' => 'required|email|max:255|unique:superviseurs,email',
            // ]);
            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'fonction' => 'required|string|max:255',
                'service' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255|unique:superviseurs,email',
            ]);


            $superviseur = Superviseur::create($validated);

            return response()->json([
                'message' => 'Superviseur enregistré avec succès',
                'data' => $superviseur
            ], 200);
        } catch (Throwable $e) {
            Log::info($e);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la creation des superviseurs.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
