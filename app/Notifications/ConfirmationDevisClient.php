<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ConfirmationDevisClient extends Notification
{
    use Queueable;

    public function __construct(public Commande $commande) {}

    public function via($notifiable): array { return ['mail']; }

    public function toMail($notifiable): MailMessage
    {
        $url = url('/commandes/' . $this->commande->reference);
        
        $mail = (new MailMessage)
            ->subject('📋 Votre devis AcadémieOHADA - ' . $this->commande->reference)
            ->greeting('Bonjour ' . $this->commande->client_prenom . ',')
            ->line('Merci pour votre confiance. Nous avons bien reçu votre demande de devis.')
            ->line('Voici un récapitulatif de votre demande :')
            ->line('**Service :** ' . $this->commande->service)
            ->line('**Sujet :** ' . $this->commande->sujet)
            ->line('**Délai choisi :** ' . $this->commande->delai)
            ->line('**Montant estimé :** ' . number_format($this->commande->montant, 0, ',', ' ') . ' FCFA')
            ->line('Notre équipe analyse actuellement votre dossier.')
            ->line('Vous recevrez une confirmation définitive sous 2 heures.')
            ->action('Voir les détails sur le site', $url)
            ->line('Si vous avez des questions, vous pouvez répondre à cet email.')
            ->salutation('L\'équipe AcadémieOHADA');

        if ($this->commande->fichier_client && Storage::exists($this->commande->fichier_client)) {
            $mail->attach(Storage::path($this->commande->fichier_client));
        }

        return $mail;
    }
}
