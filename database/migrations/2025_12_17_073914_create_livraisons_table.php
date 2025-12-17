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
    Schema::create('livraisons', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade'); 
        $table->foreignId('livreur_id')->nullable()->constrained('livreurs')->onDelete('set null'); 
        
        $table->string('statut')->default('en_attente'); 
        
        // Preuve de livraison
        $table->string('preuve_image')->nullable(); 
        $table->string('signature')->nullable(); 
        $table->string('qr_code_data')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
