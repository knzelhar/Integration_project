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
        Schema::create('dispo_horaires', function (Blueprint $table) {
            $table->bigInteger('horaire_id');
            $table->bigInteger('dispo_horaire_id');
            $table->string('dispo_horaire_type');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispo_horaires');
    }
};
