<?php

namespace App\Policies;

use App\Models\Commande;
use App\Models\User;

class CommandePolicy
{
    /**
     * Le client ne peut voir que SES commandes.
     */
    public function view(User $user, Commande $commande): bool
    {
        if ($user->hasRole('super_admin')) return true;
        if ($user->hasRole('expert')) return $commande->expert_id === $user->id;
        return $commande->user_id === $user->id;
    }

    public function download(User $user, Commande $commande): bool
    {
        return $this->view($user, $commande);
    }
}
