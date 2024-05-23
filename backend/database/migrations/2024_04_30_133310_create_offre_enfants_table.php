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
        Schema::create('offre_enfants', function (Blueprint $table) {
            $table->foreignId('enfant_id')->constrained('enfants')->onDelete('cascade');
            $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
            $table->primary(['enfant_id', 'offre_id']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_enfants');
    }
};
