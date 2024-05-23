<?php

use App\Models\parent_user;
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
        Schema::create('enfants', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable(false);
            $table->string('prenom')->nullable(false);
            $table->date('date_naiss')->nullable(false);
            $table->string('niveau_etu')->nullable(false);
            $table->foreignId('parent_id')->constrained('parent_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfants');
    }
};
