@extends('layouts.dashboard')
@section('title','Commandes')
@section('page-title','Gestion des commandes')
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link active">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
{{-- Filtres --}}
<form method="GET" class="filters-bar">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher référence, sujet..." class="form-input filter-input">
    <select name="statut" class="form-select filter-select" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        @foreach($statuts as $key => $s)
        <option value="{{ $key }}" {{ request('statut') === $key ? 'selected':'' }}>{{ $s['label'] }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-outline-navy btn-sm">Filtrer</button>
</form>

<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Référence</th><th>Client</th><th>Service</th><th>Expert</th><th>Montant</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($commandes as $cmd)
            <tr>
                <td><strong>{{ $cmd->reference }}</strong></td>
                <td>{{ $cmd->client?->nom_complet ?? '—' }}</td>
                <td>{{ $cmd->service }}</td>
                <td>{{ $cmd->expert?->nom_complet ?? '<span class="text-muted">Non assigné</span>' }}</td>
                <td>{{ number_format($cmd->montant, 0, ',', ' ') }} F</td>
                <td><span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span></td>
                <td>{{ $cmd->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ route('admin.commandes.show', $cmd) }}" class="btn btn-outline-navy btn-xs">Gérer</a></td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Aucune commande trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $commandes->links() }}
</div>
@endsection
