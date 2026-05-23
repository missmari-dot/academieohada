<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use App\Notifications\StatutCommandeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $query = Commande::with('client', 'expert')->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('reference', 'like', '%' . $request->search . '%')
                  ->orWhere('sujet', 'like', '%' . $request->search . '%');
            });
        }

        $commandes = $query->paginate(20)->withQueryString();
        $statuts   = Commande::STATUTS;

        return view('admin.commandes.index', compact('commandes', 'statuts'));
    }

    public function show(Commande $commande)
    {
        $commande->load('client', 'expert', 'fichiers');
        $experts = User::role('expert')->where('actif', true)->get();
        $statuts = Commande::STATUTS;
        return view('admin.commandes.show', compact('commande', 'experts', 'statuts'));
    }

    public function updateStatut(Request $request, Commande $commande)
    {
        $request->validate([
            'statut' => 'required|in:' . implode(',', array_keys(Commande::STATUTS)),
        ]);

        $commande->update(['statut' => $request->statut]);

        // Notifier le client
        if ($commande->client) {
            Notification::route('mail', $commande->client->email)
                ->notify(new StatutCommandeNotification($commande));
        }

        return back()->with('success', 'Statut mis à jour : ' . Commande::STATUTS[$request->statut]['label']);
    }

    public function assigner(Request $request, Commande $commande)
    {
        $request->validate(['expert_id' => 'required|exists:users,id']);

        $commande->update([
            'expert_id' => $request->expert_id,
            'statut'    => 'en_redaction',
        ]);

        // Notifier l'expert
        $expert = User::find($request->expert_id);
        if ($expert) {
            Notification::route('mail', $expert->email)
                ->notify(new \App\Notifications\NouvelleAssignationNotification($commande));
        }

        return back()->with('success', 'Expert assigné avec succès.');
    }

    public function downloadFichierClient(Commande $commande)
    {
        if (!$commande->fichier_client || !Storage::exists($commande->fichier_client)) {
            abort(404, 'Fichier client introuvable.');
        }
        $filename = basename($commande->fichier_client);
        return Storage::download($commande->fichier_client, $filename);
    }
}
