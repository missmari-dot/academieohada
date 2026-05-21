<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = User::role('client')
            ->when($request->search, fn($q) =>
                $q->where('nom', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%'))
            ->latest()->paginate(20);

        return view('admin.clients.index', compact('clients'));
    }

    public function show(User $user)
    {
        $commandes = $user->commandes()->latest()->get();
        return view('admin.clients.show', compact('user', 'commandes'));
    }
}
