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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['pack_nbr_enf', 'pack_atelier']);
<<<<<<< HEAD
            $table->integer('nbr_enfant')->nullable();
            $table->integer('nbr_atelier')->nullable();
=======
>>>>>>> f8a28ad6 (ajout de OffreController)
            $table->decimal('remise', 8, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packs');
    }
};
