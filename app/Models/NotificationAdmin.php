<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    use HasFactory;

    protected $table = 'notifications_admin';

    protected $fillable = [
        'type',
        'titre',
        'contenu',
        'lien',
        'lu',
    ];

    protected function casts(): array
    {
        return [
            'lu' => 'boolean',
        ];
    }

    public static function creer(string $type, string $titre, string $contenu, string $lien = ''): self
    {
        return self::create(compact('type', 'titre', 'contenu', 'lien'));
    }
}
