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
        Schema::create('mot_oubliers', function (Blueprint $table) {
            Schema::create('mot_oubliers', function (Blueprint $table) {
                $table->id();
                $table->string('email')->nullable();
                $table->string('token')->nullable();
                $table->integer('code')->nullable();
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mot_oubliers');
    }
};
