<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'expert_id',
        'service',
        'niveau',
        'parties',
        'filiere',
        'sujet',
        'instructions',
        'date_soutenance',
        'delai',
        'options',
        'montant',
        'mode_paiement',
        'statut',
        'fichier_client',
        'note_livraison',
        'envoi_type',
        'client_prenom',
        'client_nom',
        'client_email',
        'client_telephone',
        'client_pays',
        'client_ville',
        'client_etablissement',
    ];

    protected function casts(): array
    {
        return [
            'parties' => 'array',
            'options' => 'array',
            'date_soutenance' => 'date',
            'montant' => 'integer',
        ];
    }

    // Statuts possibles
    const STATUTS = [
        'nouveau'        => ['label' => 'Nouveau', 'color' => 'blue'],
        'confirme'       => ['label' => 'Confirmé', 'color' => 'indigo'],
        'en_redaction'   => ['label' => 'En rédaction', 'color' => 'orange'],
        'revision'       => ['label' => 'Révision', 'color' => 'yellow'],
        'livre'          => ['label' => 'Livré', 'color' => 'green'],
        'cloture'        => ['label' => 'Clôturé', 'color' => 'gray'],
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($commande) {
            if (empty($commande->reference)) {
                $annee = date('Y');
                $dernier = static::whereYear('created_at', $annee)->count() + 1;
                $commande->reference = 'CMD-' . $annee . '-' . str_pad($dernier, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // ─── Relations ────────────────────────────────────────────────────────────

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function expert()
    {
        return $this->belongsTo(User::class, 'expert_id');
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getStatutLabelAttribute(): string
    {
        return self::STATUTS[$this->statut]['label'] ?? $this->statut;
    }

    public function getStatutColorAttribute(): string
    {
        return self::STATUTS[$this->statut]['color'] ?? 'gray';
    }

    public function getClientNameAttribute(): string
    {
        if ($this->client) {
            return $this->client->prenom . ' ' . $this->client->nom;
        }
        return ($this->client_prenom . ' ' . $this->client_nom) ?: 'Client Inconnu';
    }

    public function getClientEmailAttribute(): string
    {
        return $this->client ? $this->client->email : ($this->client_email ?: '');
    }

    public function getJoursRestantsAttribute(): int
    {
        if (!$this->date_soutenance) return 0;
        return max(0, now()->diffInDays($this->date_soutenance, false));
    }

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopeEnCours($query)
    {
        return $query->whereIn('statut', ['nouveau', 'confirme', 'en_redaction', 'revision']);
    }

    public function scopeLivres($query)
    {
        return $query->where('statut', 'livre');
    }
}
