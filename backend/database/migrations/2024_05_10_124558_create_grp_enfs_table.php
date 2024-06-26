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
        Schema::create('grp_enfs', function (Blueprint $table) {
            $table->foreignId('id_grp')->constrained('groupes')->onDelete('cascade');
            $table->foreignId('id_enfant')->constrained('enfants')->onDelete('cascade');
            $table->primary(['id_grp', 'id_enfant']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grp_enfs');
    }
};
