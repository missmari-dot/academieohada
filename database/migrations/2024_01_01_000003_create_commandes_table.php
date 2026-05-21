<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 20)->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('expert_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('service', 100);
            $table->string('niveau', 20)->nullable(); // Master / Licence
            $table->json('parties')->nullable();
            $table->string('filiere')->nullable();
            $table->text('sujet');
            $table->text('instructions')->nullable();
            $table->date('date_soutenance')->nullable();
            $table->string('delai', 10); // 3j / 7j / 14j / 30j
            $table->json('options')->nullable();
            $table->unsignedInteger('montant')->default(0);
            $table->string('mode_paiement', 30)->nullable();
            $table->enum('statut', ['nouveau', 'confirme', 'en_redaction', 'revision', 'livre', 'cloture'])
                ->default('nouveau');
            $table->string('fichier_client')->nullable();
            $table->text('note_livraison')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
