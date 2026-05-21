<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'password',
        'google_id',
        'telephone',
        'pays',
        'ville',
        'etablissement',
        'niveau_etudes',
        'avatar',
        'actif',
        'derniere_connexion',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google_id',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'actif' => 'boolean',
            'derniere_connexion' => 'datetime',
        ];
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && str_starts_with($this->avatar, 'http')) {
            return $this->avatar;
        }
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        $initiales = strtoupper(substr($this->prenom, 0, 1) . substr($this->nom, 0, 1));
        return 'https://ui-avatars.com/api/?name=' . urlencode($initiales) . '&background=1a2e4a&color=f97316&size=128';
    }

    // ─── Relations ────────────────────────────────────────────────────────────

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'user_id');
    }

    public function commandesExpert()
    {
        return $this->hasMany(Commande::class, 'expert_id');
    }

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }
}
