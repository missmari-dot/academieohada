<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Connexion Google échouée. Réessayez.']);
        }

        $user = User::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if ($user) {
            // Mettre à jour google_id si absent
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->id]);
            }
            if (!$user->actif) {
                return redirect()->route('login')->withErrors(['email' => 'Votre compte est désactivé.']);
            }
        } else {
            // Créer un nouveau compte client
            $nameParts = explode(' ', $googleUser->name, 2);
            $user = User::create([
                'prenom'            => $nameParts[0] ?? $googleUser->name,
                'nom'               => $nameParts[1] ?? '',
                'email'             => $googleUser->email,
                'google_id'         => $googleUser->id,
                'avatar'            => $googleUser->avatar,
                'password'          => bcrypt(\Str::random(32)),
                'email_verified_at' => now(),
                'actif'             => true,
            ]);
            $user->assignRole('client');
        }

        Auth::login($user, true);
        $user->update(['derniere_connexion' => now()]);

        if ($user->hasRole('super_admin')) return redirect()->route('admin.dashboard');
        if ($user->hasRole('expert')) return redirect()->route('expert.dashboard');
        return redirect()->route('client.dashboard');
    }
}
