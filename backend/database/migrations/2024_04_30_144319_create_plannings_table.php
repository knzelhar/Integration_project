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
        Schema::create('plannings', function (Blueprint $table) {
            $table->foreignId('activite_id')->constrained('activites')->onDelete('cascade');
            $table->foreignId('enfant_id')->constrained('enfants')->onDelete('cascade');
            $table->primary(['activite_id', 'enfant_id']);
            $table->unsignedBigInteger('h1_id');
            $table->unsignedBigInteger('h2_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plannings');
    }
};
