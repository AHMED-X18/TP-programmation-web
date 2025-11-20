<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'phone'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    // Une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une commande contient plusieurs articles
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

