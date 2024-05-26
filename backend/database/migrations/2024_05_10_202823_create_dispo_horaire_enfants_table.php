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
        Schema::create('dispo_horaire_enfants', function (Blueprint $table) {
            $table->foreignId('horaire_id')->constrained('horaires')->onDelete('cascade');
            $table->foreignId('enfant_id')->constrained('enfants')->onDelete('cascade');
            $table->primary(['horaire_id', 'enfant_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispo_horaire_enfants');
    }
};
