<?php

namespace App\Providers;

use App\Models\Commande;
use App\Policies\CommandePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Forcer HTTPS en production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Enregistrer les policies
        Gate::policy(Commande::class, CommandePolicy::class);

        // Config admin dans l'app
        config([
            'app.admin_email'    => env('ADMIN_EMAIL', 'academie.redactionohada@gmail.com'),
            'app.admin_whatsapp' => env('ADMIN_WHATSAPP', '221775646246'),
        ]);
    }
}
