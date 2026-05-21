<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware de vérification de rôle (utilise Spatie Permission).
 * Usage dans les routes: ->middleware('role:super_admin')
 */
class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                // Vérifier que le compte est actif
                if (!$request->user()->actif) {
                    auth()->logout();
                    return redirect()->route('login')
                        ->withErrors(['email' => 'Votre compte a été désactivé.']);
                }
                return $next($request);
            }
        }

        abort(403, 'Accès non autorisé.');
    }
}
