<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    // Un article du panier appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un article du panier correspond à un produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Calculer le sous-total pour cet article
    public function subtotal()
    {
        return $this->quantity * $this->product->price;
    }
}
