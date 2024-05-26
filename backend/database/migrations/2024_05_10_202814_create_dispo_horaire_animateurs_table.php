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
        Schema::create('dispo_horaire_animateurs', function (Blueprint $table) {
            $table->foreignId('horaire_id')->constrained('horaires')->onDelete('cascade');
            $table->foreignId('animateur_id')->constrained('animateur_users')->onDelete('cascade');
            $table->primary(['horaire_id', 'animateur_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispo_horaire_animateurs');
    }
};
