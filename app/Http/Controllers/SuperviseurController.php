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

        // Vérifier si l'utilisateur est authentifié
            if (!auth()->check()) {
                Log::error('Utilisateur non authentifié');
                return response()->json([
                    'success' => false,
                    'message' => 'Utilisateur non authentifié'
                ], 401);
            }

            $userId = auth()->id();
            Log::info('User ID:', ['user_id' => $userId]);

            $query = Superviseur::query();

            // Appliquer les conditions de recherche
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('firstname', 'LIKE', "%{$search}%")
                        ->orWhere('fonction', 'LIKE', "%{$search}%")
                        ->orWhere('service', 'LIKE', "%{$search}%")
                        ->orWhere('profession', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            // Filtrer par user_id
            $query->where('user_id', $userId);

            // Exécuter la requête
            $superviseurs = $query->orderBy('id', 'desc')->paginate(8);

            Log::info('Requête SQL:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);
            Log::info('Superviseurs trouvés:', ['count' => $superviseurs->total()]);

        return response()->json([
            'success' => true,
            'superviseur' => $superviseurs
        ]);
    } catch (Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la récupération des superviseurs.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function saveSuperviseur(Request $request)
    {
        try {
            $id = $request->input('id');
            
            // Règles de validation
            $rules = [
                'firstname' => 'required|string|max:255',
                'fonction' => 'required|string|max:255',
                'service' => 'required|string|max:255',
                'profession' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255',
            ];


            // Si c'est une mise à jour, exclure l'email et le téléphone actuels de la validation unique
            if ($id) {
                $rules['email'] = 'required|email|max:255|unique:superviseurs,email,' . $id;
                $rules['phone'] = 'required|string|max:15|unique:superviseurs,phone,' . $id;
            } else {
                $rules['email'] = 'required|email|max:255|unique:superviseurs,email';
                $rules['phone'] = 'required|string|max:15|unique:superviseurs,phone';
            }

            $messages = [
                'firstname.required' => 'Le champ nom et prénom est obligatoire.',
                'fonction.required' => 'Le champ fonction est obligatoire.',
                'service.required' => 'Le champ service est obligatoire.',
                'profession.required' => 'Le champ profession est obligatoire.',
                'phone.required' => 'Le numéro de téléphone est obligatoire.',
                'phone.unique' => 'Ce numéro de téléphone est déjà utilisé. Veuillez en choisir un autre.',
                'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 15 caractères.',
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'email.unique' => 'Cet email est déjà utilisé. Veuillez en choisir un autre.',
                'email.max' => 'L\'email ne doit pas dépasser 255 caractères.',
            ];

            $validated = $request->validate($rules, $messages);

            if ($id) {
                // Mise à jour
                $superviseur = Superviseur::where('id', $id)
                    ->where('user_id', auth()->user()->id)
                    ->firstOrFail();
                
                $superviseur->update($validated);

                return response()->json([
                    'success' => true,
                    'message' => 'Superviseur mis à jour avec succès',
                    'data' => $superviseur
                ], 200);
            } else {
                // Création
                $validated['user_id'] = auth()->user()->id;
                $superviseur = Superviseur::create($validated);

                return response()->json([
                    'success' => true,
                    'message' => 'Superviseur enregistré avec succès',
                    'data' => $superviseur
                ], 200);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Les messages sont déjà traduits via le paramètre $messages de validate()
            $errors = $e->errors();
            $errorMessages = [];
            
            // Extraire tous les messages d'erreur
            foreach ($errors as $field => $messages) {
                $errorMessages = array_merge($errorMessages, $messages);
            }

            return response()->json([
                'success' => false,
                'message' => !empty($errorMessages) ? implode(' ', $errorMessages) : 'Erreur de validation',
                'errors' => $errors
            ], 422);
        } catch (Throwable $e) {
            Log::error('Erreur lors de la sauvegarde du superviseur:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du superviseur.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
