<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers l'utilisateur
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Montant total de la commande
            $table->decimal('total_amount', 10, 2);

            // Statut de la commande (ex: pending, paid, shipped)
            $table->string('status')->default('pending');

            // Adresse de livraison
            $table->text('shipping_address');

            // Numéro de téléphone
            $table->string('phone');

            // Timestamps Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

