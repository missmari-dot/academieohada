<?php
// ═══════════════════════════════════════════════════════════════════════════
// NouveauDevisNotification.php
// ═══════════════════════════════════════════════════════════════════════════
namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class NouveauDevisNotification extends Notification
{
    use Queueable;

    public function __construct(public Commande $commande, public array $client) {}

    public function via($notifiable): array { return ['mail']; }

    public function toMail($notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('📋 Nouveau devis – ' . $this->client['prenom'] . ' ' . $this->client['nom'])
            ->greeting('Bonjour Diabel,')
            ->line('Un nouveau devis a été soumis sur AcadémieOHADA.')
            ->line('**Client :** ' . $this->client['prenom'] . ' ' . $this->client['nom'])
            ->line('**Email :** ' . $this->client['email'])
            ->line('**Service :** ' . $this->commande->service)
            ->line('**Sujet :** ' . $this->commande->sujet)
            ->line('**Délai :** ' . $this->commande->delai)
            ->line('**Montant estimé :** ' . number_format($this->commande->montant, 0, ',', ' ') . ' FCFA')
            ->action('Voir la demande', url('/admin/commandes/' . $this->commande->id))
            ->line('Répondez dans les 2h pour garantir votre engagement.')
            ->salutation('AcadémieOHADA — Système de notifications');

        if ($this->commande->fichier_client && Storage::exists($this->commande->fichier_client)) {
            $mail->attach(Storage::path($this->commande->fichier_client));
        }

        return $mail;
    }
}
