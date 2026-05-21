<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function show()
    {
        return view('expert.profil', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'prenom'    => 'required|string|max:100',
            'nom'       => 'required|string|max:100',
            'telephone' => 'nullable|string|max:30',
            'pays'      => 'nullable|string|max:100',
            'ville'     => 'nullable|string|max:100',
        ]);

        auth()->user()->update($data);
        return back()->with('success', 'Profil mis à jour.');
    }
}
