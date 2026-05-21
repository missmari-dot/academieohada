<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('telephone', 30);
            $table->string('pays', 100);
            $table->string('ville', 100);
            $table->string('diplome', 50); // Licence / Master / Doctorat
            $table->string('specialite');
            $table->string('etablissement_diplome');
            $table->string('annees_experience', 20);
            $table->json('services_proposes')->nullable();
            $table->string('disponibilite', 30);
            $table->string('cv_path');
            $table->string('lettre_path')->nullable();
            $table->string('travaux_path')->nullable();
            $table->string('password_hash');
            $table->text('message_libre')->nullable();
            $table->enum('statut', ['en_attente', 'valide', 'refuse'])->default('en_attente');
            $table->text('motif_refus')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('traite_le')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
