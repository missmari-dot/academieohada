<?php

namespace App\Http\Controllers;

use App\Models\NotificationAdmin;
use App\Models\Reclamation;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
    public function index()
    {
        return view('pages.reclamations');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prenom'  => 'required|string|max:100',
            'nom'     => 'required|string|max:100',
            'email'   => 'required|email',
            'type'    => 'required|in:reclamation,suggestion',
            'message' => 'required|string|max:3000',
        ]);

        $rec = Reclamation::create([
            'user_id' => auth()->id(),
            'prenom'  => $data['prenom'],
            'nom'     => $data['nom'],
            'email'   => $data['email'],
            'type'    => $data['type'],
            'message' => $data['message'],
            'statut'  => 'nouveau',
        ]);

        NotificationAdmin::creer(
            'reclamation',
            'Nouvelle ' . ($data['type'] === 'reclamation' ? 'réclamation' : 'suggestion'),
            "{$data['prenom']} {$data['nom']} — " . substr($data['message'], 0, 80) . '…',
            route('admin.reclamations.show', $rec)
        );

        return back()->with('success', 'Votre ' . ($data['type'] === 'reclamation' ? 'réclamation' : 'suggestion') . ' a bien été envoyée. Nous vous répondons dans les 48h.');
    }
}
