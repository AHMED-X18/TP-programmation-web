<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'category',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Un produit peut être dans plusieurs paniers
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Un produit peut être dans plusieurs commandes
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

