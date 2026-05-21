<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouveauClientNotification extends Notification
{
    use Queueable;
    public function __construct(public User $client) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('👤 Nouveau client inscrit — ' . $this->client->nom_complet)
            ->greeting('Bonjour Diabel,')
            ->line('Un nouveau client vient de s\'inscrire.')
            ->line('**Nom :** ' . $this->client->nom_complet)
            ->line('**Email :** ' . $this->client->email)
            ->line('**Pays :** ' . ($this->client->pays ?? 'Non renseigné'))
            ->action('Voir le profil', url('/admin/clients/' . $this->client->id))
            ->salutation('AcadémieOHADA');
    }
}
