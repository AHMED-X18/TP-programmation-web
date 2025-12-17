<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('livreurs', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('telephone')->unique();
        $table->string('statut')->default('disponible'); // disponible, occupé, hors_ligne
        // Pour la géolocalisation du livreur en temps réel
        $table->decimal('latitude', 10, 8)->nullable();
        $table->decimal('longitude', 11, 8)->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livreurs');
    }
};
