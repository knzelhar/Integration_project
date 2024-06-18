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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable(false);
            $table->decimal('total_ht', 8, 2)->nullable(false);
            $table->decimal('total_ttc', 8, 2)->nullable(false);
            $table->enum('statut_paiment', ['a payer', 'payée', 'non payée','archivé'])->default('A payer');
            $table->string('facture_pdf')->nullable();
            $table->foreignId('devis_id')->constrained('devis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
