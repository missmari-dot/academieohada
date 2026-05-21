<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function show()
    {
        return view('client.profil', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'prenom'        => 'required|string|max:100',
            'nom'           => 'required|string|max:100',
            'telephone'     => 'nullable|string|max:30',
            'pays'          => 'nullable|string|max:100',
            'ville'         => 'nullable|string|max:100',
            'etablissement' => 'nullable|string|max:200',
            'niveau_etudes' => 'nullable|string|max:50',
        ]);

        auth()->user()->update($data);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
