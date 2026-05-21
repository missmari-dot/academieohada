<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouvelleAssignationNotification extends Notification
{
    use Queueable;
    public function __construct(public Commande $commande) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('📝 Nouvelle commande assignée — ' . $this->commande->reference)
            ->greeting('Bonjour,')
            ->line('Une nouvelle commande vous a été assignée.')
            ->line('**Référence :** ' . $this->commande->reference)
            ->line('**Service :** ' . $this->commande->service)
            ->line('**Sujet :** ' . $this->commande->sujet)
            ->line('**Délai :** ' . $this->commande->delai)
            ->action('Voir la commande', url('/expert/commandes/' . $this->commande->id))
            ->salutation("L'équipe AcadémieOHADA");
    }
}
