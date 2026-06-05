@extends('layouts.dashboard')
@section('title','Utilisateurs & Administrateurs')
@section('page-title','Gestion des utilisateurs')
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active':'' }}">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link {{ request()->routeIs('admin.commandes*') ? 'active':'' }}">📋 Commandes @if(isset($badges['devis']) && $badges['devis'])<span class="badge-pill">{{ $badges['devis'] }}</span>@endif</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link {{ request()->routeIs('admin.candidatures*') ? 'active':'' }}">👤 Candidatures @if(isset($badges['candidatures']) && $badges['candidatures'])<span class="badge-pill">{{ $badges['candidatures'] }}</span>@endif</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active':'' }}">✉️ Messages @if(isset($badges['messages']) && $badges['messages'])<span class="badge-pill">{{ $badges['messages'] }}</span>@endif</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link {{ request()->routeIs('admin.reclamations*') ? 'active':'' }}">⚠️ Réclamations @if(isset($badges['reclamations']) && $badges['reclamations'])<span class="badge-pill">{{ $badges['reclamations'] }}</span>@endif</a>
<a href="{{ route('admin.clients.index') }}" class="sidebar-link {{ request()->routeIs('admin.clients*') ? 'active':'' }}">👥 Clients</a>
<a href="{{ route('admin.experts.index') }}" class="sidebar-link {{ request()->routeIs('admin.experts*') ? 'active':'' }}">🎓 Experts</a>
<a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active':'' }}">⚙️ Administrateurs</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link {{ request()->routeIs('admin.statistiques') ? 'active':'' }}">📈 Statistiques</a>
@endsection
@section('content')
<div class="section-header-row mb-2">
    <form method="GET" class="filters-bar" style="margin-bottom: 0;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="form-input filter-input">
        <select name="role" class="form-select filter-select" onchange="this.form.submit()">
            <option value="">Tous les rôles</option>
            @foreach($roles as $r)
            <option value="{{ $r->name }}" {{ request('role') === $r->name ? 'selected':'' }}>{{ ucfirst($r->name) }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-outline-navy btn-sm">Filtrer</button>
    </form>
    <a href="{{ route('admin.users.create') }}" class="btn btn-orange btn-sm">+ Ajouter un utilisateur</a>
</div>
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Statut</th><th>Inscrit le</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td><strong>{{ $u->nom_complet }}</strong></td>
                <td>{{ $u->email }}</td>
                <td>
                    @foreach($u->roles as $role)
                        <span class="badge badge-gray">{{ ucfirst($role->name) }}</span>
                    @endforeach
                </td>
                <td><span class="badge {{ $u->actif ? 'badge-green':'badge-red' }}">{{ $u->actif ? 'Actif':'Bloqué' }}</span></td>
                <td>{{ $u->created_at->format('d/m/Y') }}</td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="{{ route('admin.users.show', $u) }}" class="btn btn-outline-navy btn-xs">Voir</a>
                        <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-outline-navy btn-xs">✏️</a>
                        @if($u->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.toggle-bloque', $u) }}" onsubmit="return confirm('Voulez-vous vraiment {{ $u->actif ? 'bloquer' : 'débloquer' }} cet utilisateur ?');">
                            @csrf @method('PUT')
                            <button type="submit" class="btn btn-outline-navy btn-xs">
                                {{ $u->actif ? '🚫' : '✅' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-navy btn-xs text-red">🗑️</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Aucun utilisateur.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
