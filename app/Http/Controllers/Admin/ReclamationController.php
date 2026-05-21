<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reclamation;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    public function index()
    {
        $reclamations = Reclamation::latest()->paginate(20);
        return view('admin.reclamations.index', compact('reclamations'));
    }

    public function show(Reclamation $reclamation)
    {
        return view('admin.reclamations.show', compact('reclamation'));
    }

    public function updateStatut(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'statut'        => 'required|in:nouveau,en_traitement,resolu',
            'reponse_admin' => 'nullable|string|max:2000',
        ]);

        $reclamation->update([
            'statut'        => $request->statut,
            'reponse_admin' => $request->reponse_admin,
        ]);

        return back()->with('success', 'Réclamation mise à jour.');
    }
}
