<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fichiers livrés par les experts
        Schema::create('fichiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->cascadeOnDelete();
            $table->string('nom_original');
            $table->string('chemin');
            $table->string('type', 10); // pdf / docx
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();
        });

        // Messages (contact + inter-utilisateurs)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sender_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('receiver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('contenu');
            $table->boolean('lu')->default(false);
            // Champs pour messages de contact public (sans compte)
            $table->string('prenom')->nullable();
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('sujet')->nullable();
            $table->timestamps();
        });

        // Réclamations & suggestions
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email');
            $table->enum('type', ['reclamation', 'suggestion'])->default('reclamation');
            $table->text('message');
            $table->enum('statut', ['nouveau', 'en_traitement', 'resolu'])->default('nouveau');
            $table->text('reponse_admin')->nullable();
            $table->timestamps();
        });

        // Notifications pour l'admin (dashboard)
        Schema::create('notifications_admin', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50); // devis / message / candidature / reclamation / client / commande
            $table->string('titre');
            $table->text('contenu');
            $table->string('lien')->nullable();
            $table->boolean('lu')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications_admin');
        Schema::dropIfExists('reclamations');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('fichiers');
    }
};
