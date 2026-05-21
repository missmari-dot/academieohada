<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.connexion');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email ou mot de passe incorrect.']);
        }

        $user = Auth::user();

        if (!$user->actif) {
            Auth::logout();
            return back()->withErrors(['email' => 'Votre compte a été désactivé. Contactez-nous.']);
        }

        // Mise à jour dernière connexion
        $user->update(['derniere_connexion' => now()]);

        $request->session()->regenerate();

        // Redirection selon le rôle
        if ($user->hasRole('super_admin')) {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->hasRole('expert')) {
            return redirect()->intended(route('expert.dashboard'));
        } else {
            return redirect()->intended(route('client.dashboard'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Vous êtes déconnecté.');
    }

    public function forgotForm()
    {
        return view('auth.mot-de-passe-oublie');
    }

    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetForm(Request $request, string $token)
    {
        return view('auth.reinitialiser-mot-de-passe', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])/',
        ], [
            'password.regex' => 'Le mot de passe doit contenir au moins 1 majuscule, 1 chiffre et 1 caractère spécial.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Mot de passe réinitialisé.')
            : back()->withErrors(['email' => __($status)]);
    }
}
