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
        Schema::table('commandes', function (Blueprint $table) {
            // Rendre user_id nullable (changement de contrainte)
            $table->foreignId('user_id')->nullable()->change();
            
            // Ajouter les colonnes d'informations client (pour les invités)
            $table->string('client_prenom', 100)->nullable()->after('user_id');
            $table->string('client_nom', 100)->nullable()->after('client_prenom');
            $table->string('client_email', 150)->nullable()->after('client_nom');
            $table->string('client_telephone', 30)->nullable()->after('client_email');
            $table->string('client_pays', 100)->nullable()->after('client_telephone');
            $table->string('client_ville', 100)->nullable()->after('client_pays');
            $table->string('client_etablissement', 200)->nullable()->after('client_ville');
            
            // Nouveau champ pour le type d'envoi préféré (whatsapp, email)
            $table->string('envoi_type', 20)->default('whatsapp')->after('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
            
            $table->dropColumn([
                'client_prenom', 'client_nom', 'client_email', 'client_telephone',
                'client_pays', 'client_ville', 'client_etablissement', 'envoi_type'
            ]);
        });
    }
};
