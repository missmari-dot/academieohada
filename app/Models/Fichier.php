<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'nom_original',
        'chemin',
        'type',
        'uploaded_by',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function uploadeur()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
