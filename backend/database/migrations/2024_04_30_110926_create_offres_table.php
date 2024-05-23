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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('titre');
=======
>>>>>>> f8a28ad6 (ajout de OffreController)
            $table->timestamp('date_creation')->nullable(false);
            $table->timestamp('date_mise_a_jour')->nullable();
            $table->date('date_debut_insc')->nullable(false);
            $table->date('date_fin_insc')->nullable(false);
            $table->text('description');
            $table->text('message_pub');
            $table->decimal('remise', 8, 2)->nullable()->default(0);
            $table->float('volume_horaire')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
