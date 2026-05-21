<?php

namespace App\Notifications;

use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CandidatureValideeNotification extends Notification
{
    use Queueable;
    public function __construct(public Candidature $candidature) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('🎉 Votre candidature a été acceptée — AcadémieOHADA')
            ->greeting('Bonjour ' . $this->candidature->prenom . ',')
            ->line('Félicitations ! Votre candidature pour rejoindre l\'équipe AcadémieOHADA a été **acceptée**.')
            ->line('Votre compte expert a été créé. Vous pouvez vous connecter dès maintenant.')
            ->line('**Email :** ' . $this->candidature->email)
            ->line('**Mot de passe :** celui choisi lors de votre candidature.')
            ->action('Se connecter', url('/connexion'))
            ->line('Bienvenue dans l\'équipe AcadémieOHADA !')
            ->salutation('L\'équipe AcadémieOHADA');
    }
}
