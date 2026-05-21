<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user      = auth()->user();
        $commandes = $user->commandes()->latest()->get();

        $stats = [
            'total'      => $commandes->count(),
            'en_cours'   => $commandes->whereIn('statut', ['nouveau','confirme','en_redaction','revision'])->count(),
            'livres'     => $commandes->where('statut', 'livre')->count(),
            'en_attente' => $commandes->where('statut', 'nouveau')->count(),
        ];

        $recentes = $commandes->take(5);

        return view('client.dashboard', compact('user', 'stats', 'recentes'));
    }
}
