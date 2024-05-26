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
         Schema::create('enfant_paiements', function (Blueprint $table) {
            $table->foreignId('enfant_id')->constrained('enfants')->onDelete('cascade');
            $table->foreignId('paiement_id')->constrained('option_paiements')->onDelete('cascade');
            $table->primary(['enfant_id', 'paiement_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfant_paiements');
    }
};
