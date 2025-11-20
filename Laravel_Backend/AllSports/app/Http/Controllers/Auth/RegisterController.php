<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Pour API, on n’a pas besoin du formulaire Blade
    public function showRegistrationForm()
    {
        return response()->json([
            'message' => 'Endpoint pour l’inscription via POST'
        ]);
    }

    // Traiter l'inscription et retourner JSON
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500'
        ]);

        // Création de l’utilisateur
        $user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
	]);


        // Connexion automatique (facultatif pour API)
        Auth::login($user);

        // Retour JSON
        return response()->json([
            'message' => 'Inscription réussie !',
            'user' => $user
        ], 201); // HTTP 201 = créé
    }
}

