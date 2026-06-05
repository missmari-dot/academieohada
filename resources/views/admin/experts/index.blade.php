@extends('layouts.dashboard')
@section('title','Experts')
@section('page-title','Experts actifs')
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
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un expert..." class="form-input filter-input">
        <button type="submit" class="btn btn-outline-navy btn-sm">Rechercher</button>
    </form>
    <a href="{{ route('admin.experts.create') }}" class="btn btn-orange btn-sm">+ Ajouter un expert</a>
</div>
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Nom</th><th>Email</th><th>Pays</th><th>Commandes actives</th><th>Statut</th><th>Inscrit le</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($experts as $e)
            <tr>
                <td><strong>{{ $e->nom_complet }}</strong></td>
                <td>{{ $e->email }}</td>
                <td>{{ $e->pays ?? '—' }}</td>
                <td>{{ $e->commandesExpert()->whereIn('statut',['confirme','en_redaction','revision'])->count() }}</td>
                <td><span class="badge {{ $e->actif ? 'badge-green':'badge-red' }}">{{ $e->actif ? 'Actif':'Désactivé' }}</span></td>
                <td>{{ $e->created_at->format('d/m/Y') }}</td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="{{ route('admin.experts.show', $e) }}" class="btn btn-outline-navy btn-xs">Voir</a>
                        <a href="{{ route('admin.experts.edit', $e) }}" class="btn btn-outline-navy btn-xs">✏️</a>
                        <form method="POST" action="{{ route('admin.experts.toggle-bloque', $e) }}" onsubmit="return confirm('Voulez-vous vraiment {{ $e->actif ? 'bloquer' : 'débloquer' }} cet expert ?');">
                            @csrf @method('PUT')
                            <button type="submit" class="btn btn-outline-navy btn-xs">
                                {{ $e->actif ? '🚫' : '✅' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.experts.destroy', $e) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet expert ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-navy btn-xs text-red">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Aucun expert.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $experts->links() }}
</div>
@endsection
