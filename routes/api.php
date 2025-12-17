<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\API\LivreurController;
use App\Http\Controllers\API\LivraisonController;

// Route de test pour l'inscription (PUBLIC - pas de middleware auth)
Route::post('/register-test', function(Request $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone ?? null,
        'role' => 'client'
    ]);

    return response()->json([
        'message' => 'Utilisateur créé',
        'user' => $user
    ], 201);
});

// Route de test pour la connexion (PUBLIC)
Route::post('/login-test', function(Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Identifiants invalides'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'role' => $user->role
    ]);
});
// === 1. CRUD Livreurs ===
Route::apiResource('livreurs', LivreurController::class);

// === 2. CRUD Livraisons ===
Route::get('livraisons', [LivraisonController::class, 'index']);
Route::get('livraisons/{id}', [LivraisonController::class, 'show']);

// === 3. Assignation Livreur -> Commande ===
Route::post('livraisons/{id}/assigner', [LivraisonController::class, 'assignerLivreur']);

// === 4. API Géolocalisation (Mise à jour position livreur) ===
Route::post('livreurs/{id}/position', [LivreurController::class, 'updatePosition']);

// === 5. API Preuve de Livraison (Upload) ===
Route::post('livraisons/{id}/confirmer', [LivraisonController::class, 'confirmerLivraison']);