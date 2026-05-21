<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'sender_id',
        'receiver_id',
        'contenu',
        'lu',
        // Champs pour messages de contact (sans commande)
        'prenom',
        'nom',
        'email',
        'telephone',
        'sujet',
    ];

    protected function casts(): array
    {
        return [
            'lu' => 'boolean',
        ];
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
