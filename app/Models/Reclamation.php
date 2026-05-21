<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prenom', 'nom', 'email',
        'type',
        'message',
        'statut',
        'reponse_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNomCompletAttribute(): string
    {
        if ($this->user) return $this->user->nom_complet;
        return $this->prenom . ' ' . $this->nom;
    }
}
