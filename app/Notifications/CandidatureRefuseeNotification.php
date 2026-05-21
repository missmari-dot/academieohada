<?php

namespace App\Notifications;

use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CandidatureRefuseeNotification extends Notification
{
    use Queueable;
    public function __construct(public Candidature $candidature) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Candidature AcadémieOHADA')
            ->greeting('Bonjour ' . $this->candidature->prenom . ',')
            ->line('Nous avons bien examiné votre candidature pour rejoindre l\'équipe AcadémieOHADA.')
            ->line('Après étude de votre profil, nous ne sommes pas en mesure de donner suite à votre candidature pour le moment.');
        if ($this->candidature->motif_refus) {
            $mail->line('**Motif :** ' . $this->candidature->motif_refus);
        }
        return $mail
            ->line('Nous vous encourageons à repostuler ultérieurement.')
            ->salutation('L\'équipe AcadémieOHADA');
    }
}
