<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\User;
use App\Notifications\CandidatureValideeNotification;
use App\Notifications\CandidatureRefuseeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    public function index(Request $request)
    {
        $query = Candidature::latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $candidatures = $query->paginate(20);
        return view('admin.candidatures.index', compact('candidatures'));
    }

    public function show(Candidature $candidature)
    {
        return view('admin.candidatures.show', compact('candidature'));
    }

    public function valider(Request $request, Candidature $candidature)
    {
        if ($candidature->statut !== 'en_attente') {
            return back()->withErrors(['Cette candidature a déjà été traitée.']);
        }

        // Créer le compte expert
        $user = User::create([
            'prenom'            => $candidature->prenom,
            'nom'               => $candidature->nom,
            'email'             => $candidature->email,
            'password'          => $candidature->password_hash, // déjà hashé
            'telephone'         => $candidature->telephone,
            'pays'              => $candidature->pays,
            'ville'             => $candidature->ville,
            'email_verified_at' => now(),
            'actif'             => true,
        ]);

        $user->assignRole('expert');

        // Mettre à jour la candidature
        $candidature->update([
            'statut'    => 'valide',
            'admin_id'  => auth()->id(),
            'traite_le' => now(),
        ]);

        // Notifier l'expert par email
        Notification::route('mail', $candidature->email)
            ->notify(new CandidatureValideeNotification($candidature));

        return redirect()->route('admin.candidatures')
            ->with('success', "Candidature validée. Compte expert créé pour {$candidature->nom_complet}.");
    }

    public function refuser(Request $request, Candidature $candidature)
    {
        $request->validate([
            'motif_refus' => 'nullable|string|max:1000',
        ]);

        $candidature->update([
            'statut'      => 'refuse',
            'motif_refus' => $request->motif_refus,
            'admin_id'    => auth()->id(),
            'traite_le'   => now(),
        ]);

        Notification::route('mail', $candidature->email)
            ->notify(new CandidatureRefuseeNotification($candidature));

        return redirect()->route('admin.candidatures')
            ->with('success', "Candidature refusée. Le candidat a été notifié.");
    }

    public function downloadCv(Candidature $candidature)
    {
        if (!Storage::exists($candidature->cv_path)) {
            abort(404, 'CV introuvable.');
        }
        return Storage::download($candidature->cv_path, "CV_{$candidature->nom}_{$candidature->prenom}.pdf");
    }
}
