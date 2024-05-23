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
        Schema::create('option_paiements', function (Blueprint $table) {
            $table->id();
            $table->enum('designation',['mensuel', 'Trimestriel', 'semestriel', 'annuel'])->nullable(false);
            $table->decimal('remise', 8, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_paiements');
    }
};
