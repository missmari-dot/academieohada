<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouveauMessageNotification extends Notification
{
    use Queueable;
    public function __construct(public Message $message) {}
    public function via($notifiable): array { return ['mail']; }
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('✉️ Nouveau message — ' . $this->message->sujet)
            ->greeting('Bonjour Diabel,')
            ->line('Nouveau message reçu via le formulaire de contact.')
            ->line('**De :** ' . $this->message->prenom . ' ' . $this->message->nom)
            ->line('**Email :** ' . $this->message->email)
            ->line('**Sujet :** ' . $this->message->sujet)
            ->action('Lire le message', url('/admin/messages/' . $this->message->id))
            ->salutation('AcadémieOHADA');
    }
}
