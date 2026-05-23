<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\NotificationAdmin;
use App\Notifications\NouveauClientNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.inscription');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'prenom'      => 'required|string|max:100',
            'nom'         => 'required|string|max:100',
            'email'       => 'required|email|unique:users,email',
            'telephone'   => 'required|string|max:30',
            'pays'        => 'required|string|max:100',
            'ville'       => 'nullable|string|max:100',
            'etablissement' => 'nullable|string|max:150',
            'niveau_etudes' => 'nullable|string|max:50',
            'password'    => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])/'],
            'cgu'         => 'required|accepted',
        ], [
            'password.regex' => 'Le mot de passe doit contenir au moins 1 majuscule, 1 chiffre et 1 caractère spécial.',
            'cgu.accepted'   => 'Vous devez accepter les conditions générales d\'utilisation.',
        ]);

        $user = User::create([
            'prenom'        => $data['prenom'],
            'nom'           => $data['nom'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'telephone'     => $data['telephone'],
            'pays'          => $data['pays'],
            'ville'         => $data['ville'] ?? null,
            'etablissement' => $data['etablissement'] ?? null,
            'niveau_etudes' => $data['niveau_etudes'] ?? null,
            'actif'         => true,
            'email_verified_at' => now(),
        ]);

        $user->assignRole('client');

        event(new Registered($user));

        Auth::login($user);

        // Notifier l'admin
        NotificationAdmin::creer(
            'client',
            'Nouveau client inscrit',
            "{$user->prenom} {$user->nom} vient de créer un compte.",
            route('admin.clients.show', $user)
        );

        // Email admin
        NotificationFacade::route('mail', config('mail.from.address'))
            ->notify(new NouveauClientNotification($user));

        return redirect()->route('client.dashboard')->with('success', 'Votre compte a été créé avec succès ! Bienvenue sur AcadémieOHADA.');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('client.dashboard')->with('success', 'Email vérifié ! Bienvenue sur AcadémieOHADA.');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Email de vérification renvoyé.');
    }
}
