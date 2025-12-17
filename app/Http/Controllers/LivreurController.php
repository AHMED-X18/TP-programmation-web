<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    // 1. CRUD : Liste des livreurs
    public function index()
    {
        return response()->json(Livreur::all());
    }

    // 1. CRUD : Créer un livreur
    public function store(Request $request)
    {
        $request->validate(['nom' => 'required', 'telephone' => 'required']);
        $livreur = Livreur::create($request->all());
        return response()->json($livreur, 201);
    }

    // 4. API GÉOLOCALISATION : Mettre à jour la position
    public function updatePosition(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $livreur = Livreur::findOrFail($id);
        $livreur->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json(['message' => 'Position mise à jour', 'livreur' => $livreur]);
    }
}