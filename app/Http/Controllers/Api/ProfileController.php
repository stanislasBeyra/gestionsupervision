<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profileinfo()
    {
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at
                ]
            ]
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'current_password' => ['required_with:new_password'],
                'new_password' => ['nullable', 'min:8', 'confirmed'],
            ]);

            if ($request->filled('current_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Le mot de passe actuel est incorrect.'
                    ], 422);
                }
                $user->password = Hash::make($request->new_password);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Profil mis à jour avec succès',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at
                    ]
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour du profil'
            ], 500);
        }
    }
} 