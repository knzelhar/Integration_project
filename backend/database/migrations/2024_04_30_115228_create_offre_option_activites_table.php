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
        Schema::create('offre_option_activites', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
            $table->foreignId('option_pay_id')->constrained('option_paiements')->onDelete('cascade');
            $table->foreignId('activite_id')->constrained('activites')->onDelete('cascade');
            $table->decimal('tarif', 8, 2)->nullable(false);
            $table->integer('nbr_seances_sem')->nullable(false);
            $table->float('duree')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_option_activites');
    }
};
