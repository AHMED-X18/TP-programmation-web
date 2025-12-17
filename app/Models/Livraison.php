<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'livreur_id',
        'statut',
        'preuve_image',
        'signature',
        'qr_code_data'
    ];

    // Lien avec la commande (Order)
    public function order()
    {
        return $this->belongsTo(Order::class); // Assurez-vous d'avoir un modèle Order
    }

    // Lien avec le livreur
    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}