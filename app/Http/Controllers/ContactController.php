<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\NotificationAdmin;
use App\Notifications\NouveauMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prenom'    => 'required|string|max:100',
            'nom'       => 'required|string|max:100',
            'email'     => 'required|email',
            'telephone' => 'nullable|string|max:30',
            'sujet'     => 'required|string|max:200',
            'contenu'   => 'required|string|max:3000',
        ]);

        $message = Message::create([
            'prenom'    => $data['prenom'],
            'nom'       => $data['nom'],
            'email'     => $data['email'],
            'telephone' => $data['telephone'] ?? null,
            'sujet'     => $data['sujet'],
            'contenu'   => $data['contenu'],
            'lu'        => false,
        ]);

        NotificationAdmin::creer(
            'message',
            'Nouveau message de contact',
            "{$data['prenom']} {$data['nom']} — {$data['sujet']}",
            route('admin.messages.show', $message)
        );

        Notification::route('mail', config('app.admin_email', config('mail.from.address')))
            ->notify(new NouveauMessageNotification($message));

        // WhatsApp admin
        $waUrl = $this->genererWhatsApp($data);

        return redirect()->away($waUrl);
    }

    private function genererWhatsApp(array $data): string
    {
        $msg = "✉️ *NOUVEAU MESSAGE — AcadémieOHADA*\n\n"
            . "👤 {$data['prenom']} {$data['nom']}\n"
            . "📧 {$data['email']}\n"
            . "📌 Sujet : {$data['sujet']}\n\n"
            . "💬 {$data['contenu']}";

        return 'https://wa.me/' . config('app.admin_whatsapp', '221775646246')
            . '?text=' . rawurlencode($msg);
    }
}
