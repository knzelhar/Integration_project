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
            $table->string('date_dem')->nullable(false);
            $table->enum('statut_dem',['en cours', 'brouillon', 'envoye'])->default('en cours');
            $table->enum('statut_admin',['non traitée', 'acceptée', 'refusée'])->default('non traitée');
            $table->text('motif_refus_parent')->nullable();
            $table->date('date_traitement')->nullable();
            $table->text('motif_refus_admin')->nullable();
            $table->foreignId('parent_id')->constrained('parent_users')->onDelete('cascade');
            $table->foreignId('pack_id')->nullable()->constrained('packs')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admin_users')->onDelete('cascade');
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
    public function priority(): int
    {
        return 1;
    }
};
