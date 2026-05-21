<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommandeLivreeNotification extends Notification
{
    use Queueable;
    public function __construct(public Commande $commande) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('✅ Votre commande est prête — ' . $this->commande->reference)
            ->greeting('Bonjour,')
            ->line('Bonne nouvelle ! Votre commande **' . $this->commande->reference . '** a été livrée.')
            ->line('**Sujet :** ' . $this->commande->sujet)
            ->line('Connectez-vous à votre espace client pour télécharger vos fichiers.')
            ->action('Accéder à ma commande', url('/client/commandes/' . $this->commande->id))
            ->line('Merci de votre confiance.')
            ->salutation('L\'équipe AcadémieOHADA');
    }
}
