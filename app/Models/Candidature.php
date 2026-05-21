<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom', 'nom', 'email', 'telephone',
        'pays', 'ville',
        'diplome', 'specialite', 'etablissement_diplome',
        'annees_experience',
        'services_proposes',
        'disponibilite',
        'cv_path', 'lettre_path', 'travaux_path',
        'password_hash',
        'message_libre',
        'statut',
        'motif_refus',
        'admin_id',
        'traite_le',
    ];

    protected function casts(): array
    {
        return [
            'services_proposes' => 'array',
            'traite_le' => 'datetime',
        ];
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
