<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

    // Autoriser la modification de ces champs
    protected $fillable = [
        'nom', 
        'telephone', 
        'statut', 
        'latitude', 
        'longitude'
    ];

    // Un livreur a plusieurs livraisons
    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
}