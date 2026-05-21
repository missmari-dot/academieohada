<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Fichier;
use App\Models\NotificationAdmin;
use App\Notifications\CommandeLivreeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = auth()->user()->commandesExpert()
            ->with('client')
            ->latest()
            ->paginate(10);
        return view('expert.commandes.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        if ($commande->expert_id !== auth()->id()) abort(403);
        $commande->load('client', 'fichiers');
        return view('expert.commandes.show', compact('commande'));
    }

    public function livrer(Request $request, Commande $commande)
    {
        if ($commande->expert_id !== auth()->id()) abort(403);

        $request->validate([
            'fichier_pdf'  => 'required|file|mimes:pdf|max:20480',
            'fichier_docx' => 'required|file|mimes:docx,doc|max:20480',
            'note'         => 'nullable|string|max:1000',
        ]);

        // Stocker PDF
        $this->saveFichier($request->file('fichier_pdf'), $commande, 'pdf');
        // Stocker DOCX
        $this->saveFichier($request->file('fichier_docx'), $commande, 'docx');

        // Mettre à jour la commande
        $commande->update([
            'statut'         => 'livre',
            'note_livraison' => $request->note,
        ]);

        // Notifier le client par email
        Notification::route('mail', $commande->client->email)
            ->notify(new CommandeLivreeNotification($commande));

        // Notifier l'admin
        NotificationAdmin::creer(
            'commande',
            'Commande livrée',
            "{$commande->reference} — {$commande->sujet}",
            route('admin.commandes.show', $commande)
        );

        return back()->with('success', 'Commande marquée comme livrée. Le client a été notifié.');
    }

    private function saveFichier($file, Commande $commande, string $type): void
    {
        $uuid     = Str::uuid();
        $ext      = $file->getClientOriginalExtension();
        $chemin   = "private/livraisons/{$commande->reference}/{$uuid}.{$ext}";
        Storage::put($chemin, file_get_contents($file));

        Fichier::create([
            'commande_id'  => $commande->id,
            'nom_original' => $file->getClientOriginalName(),
            'chemin'       => $chemin,
            'type'         => $type,
            'uploaded_by'  => auth()->id(),
        ]);
    }
}
