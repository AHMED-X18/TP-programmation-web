<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un utilisateur peut avoir plusieurs articles dans son panier
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Un utilisateur peut avoir plusieurs commandes
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Calculer le total du panier
    public function cartTotal()
    {
        return $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
