<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = User::role('expert')->latest()->paginate(20);
        return view('admin.experts.index', compact('experts'));
    }

    public function show(User $user)
    {
        $commandes = $user->commandesExpert()->latest()->get();
        return view('admin.experts.show', compact('user', 'commandes'));
    }

    public function toggleActif(User $user)
    {
        $user->update(['actif' => !$user->actif]);
        $etat = $user->actif ? 'activé' : 'désactivé';
        return back()->with('success', "Compte expert {$etat}.");
    }
}
