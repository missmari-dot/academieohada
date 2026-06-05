<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExpertController extends Controller
{
    public function index(Request $request)
    {
        $experts = User::role('expert')
            ->when($request->search, fn($q) =>
                $q->where('nom', 'like', '%'.$request->search.'%')
                  ->orWhere('prenom', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%'))
            ->latest()->paginate(20);

        return view('admin.experts.index', compact('experts'));
    }

    public function create()
    {
        return view('admin.experts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:30',
        ]);

        $user = User::create([
            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telephone' => $data['telephone'],
            'actif' => true,
        ]);

        $user->assignRole('expert');

        return redirect()->route('admin.experts.index')->with('success', 'Expert créé avec succès.');
    }

    public function show(User $user)
    {
        abort_if(!$user->hasRole('expert'), 404);
        $commandes = $user->commandesExpert()->latest()->get();
        return view('admin.experts.show', compact('user', 'commandes'));
    }

    public function edit(User $user)
    {
        abort_if(!$user->hasRole('expert'), 404);
        return view('admin.experts.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_if(!$user->hasRole('expert'), 404);

        $data = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'telephone' => 'nullable|string|max:30',
        ]);

        $user->update([
            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.experts.index')->with('success', 'Expert mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        abort_if(!$user->hasRole('expert'), 404);
        $user->delete();
        return redirect()->route('admin.experts.index')->with('success', 'Expert supprimé.');
    }

    public function toggleBloque(User $user)
    {
        abort_if(!$user->hasRole('expert'), 404);
        $user->update(['actif' => !$user->actif]);
        $etat = $user->actif ? 'activé' : 'désactivé';
        return back()->with('success', "Compte expert {$etat}.");
    }
}
