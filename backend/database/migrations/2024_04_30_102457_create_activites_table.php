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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable(false);
            $table->text('description');
            $table->string('objectif');
            $table->string('image_pub')->nullable();
            $table->string('lien_youtube')->nullable();
            $table->text('descriptif');
            $table->integer('age_min')->nullable(false);
            $table->integer('age_max')->nullable(false);
            $table->integer('eff_min')->nullable(false);
            $table->integer('eff_max')->nullable(false);
            $table->decimal('prix', 8, 2)->nullable(false);
            $table->foreignId('animateur_id')->nullable()->constrained('animateur_users')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admin_users')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('type_activites')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
