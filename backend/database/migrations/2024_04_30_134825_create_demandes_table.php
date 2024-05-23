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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_dem')->nullable(false);
            $table->enum('statut_dem',['en cours', 'brouillon', 'envoye'])->default('en cours');
<<<<<<< HEAD
            $table->enum('statut_admin',['non traitée', 'acceptée', 'refusée'])->default('non traitée');
=======
            $table->boolean('statut_admin')->default(false);
>>>>>>> f8a28ad6 (ajout de OffreController)
            $table->text('motif_refus_parent')->nullable();
            $table->timestamp('date_traitement')->nullable();
            $table->text('motif_refus_admin')->nullable();
            $table->foreignId('parent_id')->constrained('parent_users')->onDelete('cascade');
            $table->foreignId('pack_id')->constrained('packs')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admin_users')->onDelete('cascade');
            $table->foreignId('devis_id')->constrained('devis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
