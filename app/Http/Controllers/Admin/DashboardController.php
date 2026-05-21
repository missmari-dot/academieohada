<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Candidature;
use App\Models\Message;
use App\Models\NotificationAdmin;
use App\Models\Reclamation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'commandes'      => Commande::count(),
            'clients'        => User::role('client')->count(),
            'experts_actifs' => User::role('expert')->where('actif', true)->count(),
            'a_traiter'      => Commande::where('statut', 'nouveau')->count(),
        ];

        $badges = [
            'devis'        => Commande::where('statut', 'nouveau')->count(),
            'candidatures' => Candidature::where('statut', 'en_attente')->count(),
            'messages'     => Message::where('lu', false)->whereNull('commande_id')->count(),
            'reclamations' => Reclamation::where('statut', 'nouveau')->count(),
        ];

        $notifications = NotificationAdmin::where('lu', false)->latest()->take(20)->get();
        $commandes     = Commande::with('client')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'badges', 'notifications', 'commandes'));
    }

    public function lireToutesNotifications(Request $request)
    {
        NotificationAdmin::where('lu', false)->update(['lu' => true]);
        return back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
}
