<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatutCommandeNotification extends Notification
{
    use Queueable;
    public function __construct(public Commande $commande) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('📋 Mise à jour de votre commande — ' . $this->commande->reference)
            ->greeting('Bonjour,')
            ->line('Le statut de votre commande **' . $this->commande->reference . '** a été mis à jour.')
            ->line('**Nouveau statut :** ' . $this->commande->statut_label)
            ->action('Voir ma commande', url('/client/commandes/' . $this->commande->id))
            ->salutation('L\'équipe AcadémieOHADA');
    }
}
