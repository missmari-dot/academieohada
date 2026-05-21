<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user      = auth()->user();
        $commandes = $user->commandesExpert()->latest()->get();

        $stats = [
            'actives'       => $commandes->whereIn('statut', ['confirme','en_redaction','revision'])->count(),
            'livrees_mois'  => $commandes->where('statut', 'livre')
                                ->where('updated_at', '>=', now()->startOfMonth())->count(),
            'note_moyenne'  => '4.8',
        ];

        $actives = $commandes->whereIn('statut', ['confirme','en_redaction','revision'])->values();

        return view('expert.dashboard', compact('user', 'stats', 'actives'));
    }
}
