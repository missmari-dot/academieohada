<?php

namespace App\Notifications;

use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouvelleCandidatureNotification extends Notification
{
    use Queueable;
    public function __construct(public Candidature $candidature) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('👤 Nouvelle candidature – ' . $this->candidature->nom_complet)
            ->greeting('Bonjour Diabel,')
            ->line('Une nouvelle candidature expert a été soumise.')
            ->line('**Nom :** ' . $this->candidature->nom_complet)
            ->line('**Spécialité :** ' . $this->candidature->specialite)
            ->line('**Diplôme :** ' . $this->candidature->diplome)
            ->line('**Expérience :** ' . $this->candidature->annees_experience . ' ans')
            ->action('Examiner la candidature', url('/admin/candidatures/' . $this->candidature->id))
            ->salutation('AcadémieOHADA');
    }
}
