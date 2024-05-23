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
            $table->string('titre')->nullable(false);
            $table->string('date_creation')->nullable();
            $table->string('date_mise_a_jour')->nullable();
            $table->string('date_debut_insc')->nullable();
            $table->string('date_fin_insc')->nullable();
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
