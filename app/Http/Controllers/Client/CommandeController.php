<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Fichier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = auth()->user()->commandes()->latest()->paginate(10);
        return view('client.commandes.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        // S'assurer que la commande appartient au client connecté
        $this->authorize('view', $commande);

        $commande->load('fichiers', 'expert');
        $timeline = $this->buildTimeline($commande);

        return view('client.commandes.show', compact('commande', 'timeline'));
    }

    public function download(Commande $commande, Fichier $fichier)
    {
        $this->authorize('view', $commande);

        if ($commande->statut !== 'livre' && $commande->statut !== 'cloture') {
            abort(403, 'Fichier non disponible.');
        }

        if (!Storage::exists($fichier->chemin)) {
            abort(404, 'Fichier introuvable.');
        }

        return Storage::download($fichier->chemin, $fichier->nom_original);
    }

    private function buildTimeline(Commande $commande): array
    {
        $steps = [
            ['key' => 'nouveau',       'label' => 'Devis reçu'],
            ['key' => 'confirme',      'label' => 'Commande confirmée'],
            ['key' => 'en_redaction',  'label' => 'Expert assigné & rédaction'],
            ['key' => 'revision',      'label' => 'En révision'],
            ['key' => 'livre',         'label' => 'Livraison'],
            ['key' => 'cloture',       'label' => 'Clôturé'],
        ];

        $statutsOrdre = ['nouveau','confirme','en_redaction','revision','livre','cloture'];
        $indexActuel  = array_search($commande->statut, $statutsOrdre);

        foreach ($steps as &$step) {
            $indexStep = array_search($step['key'], $statutsOrdre);
            if ($indexStep < $indexActuel) {
                $step['etat'] = 'done';
            } elseif ($indexStep === $indexActuel) {
                $step['etat'] = 'current';
            } else {
                $step['etat'] = 'pending';
            }
        }

        return $steps;
    }
}
