<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function index()
    {
        $stats = [
            'ca_total'        => Commande::where('statut', 'livre')->sum('montant'),
            'ca_mois'         => Commande::where('statut', 'livre')
                                    ->whereMonth('updated_at', now()->month)->sum('montant'),
            'commandes_total' => Commande::count(),
            'clients_total'   => User::role('client')->count(),
        ];

        $commandesParMois = Commande::select(
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('YEAR(created_at) as annee'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(montant) as ca')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('annee', 'mois')
            ->orderBy('mois')
            ->get();

        $commandesParStatut = Commande::select('statut', DB::raw('COUNT(*) as total'))
            ->groupBy('statut')
            ->get();

        return view('admin.statistiques', compact('stats', 'commandesParMois', 'commandesParStatut'));
    }
}
