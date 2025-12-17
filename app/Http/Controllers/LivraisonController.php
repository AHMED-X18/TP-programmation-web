<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Livreur;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    public function index()
    {
        // Retourne les livraisons avec les infos de la commande et du livreur
        return response()->json(Livraison::with(['order', 'livreur'])->get());
    }

    // 3. ASSIGNATION LIVREUR -> COMMANDE
    public function assignerLivreur(Request $request, $id)
    {
        $request->validate(['livreur_id' => 'required|exists:livreurs,id']);

        $livraison = Livraison::findOrFail($id);
        $livraison->livreur_id = $request->livreur_id;
        $livraison->statut = 'recupere'; // Ou 'en_cours'
        $livraison->save();
        
        // On peut aussi mettre le livreur en "occupé"
        $livreur = Livreur::find($request->livreur_id);
        $livreur->update(['statut' => 'occupé']);

        return response()->json(['message' => 'Livreur assigné avec succès', 'data' => $livraison]);
    }

    // 5. API PREUVE DE LIVRAISON (Image, Signature, QR)
    public function confirmerLivraison(Request $request, $id)
    {
        $request->validate([
            'preuve_image' => 'nullable|image|max:2048', // Max 2MB
            'signature' => 'nullable|string', // Peut être une image base64 ou un fichier
            'qr_code' => 'nullable|string'
        ]);

        $livraison = Livraison::findOrFail($id);
        $dataToUpdate = ['statut' => 'livre'];

        // Gestion de l'upload d'image
        if ($request->hasFile('preuve_image')) {
            $path = $request->file('preuve_image')->store('preuves', 'public');
            $dataToUpdate['preuve_image'] = $path;
        }

        // Gestion du code QR
        if ($request->filled('qr_code')) {
            $dataToUpdate['qr_code_data'] = $request->qr_code;
        }

        $livraison->update($dataToUpdate);

        // Libérer le livreur
        if($livraison->livreur_id) {
            Livreur::find($livraison->livreur_id)->update(['statut' => 'disponible']);
        }

        return response()->json(['message' => 'Livraison confirmée !', 'data' => $livraison]);
    }
}