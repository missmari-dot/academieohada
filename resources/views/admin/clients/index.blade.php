@extends('layouts.dashboard')
@section('title','Clients')
@section('page-title','Gestion des clients')
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link active">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
<form method="GET" class="filters-bar">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un client..." class="form-input filter-input">
    <button type="submit" class="btn btn-outline-navy btn-sm">Rechercher</button>
</form>
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Nom</th><th>Email</th><th>Pays</th><th>Établissement</th><th>Commandes</th><th>Inscrit le</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($clients as $c)
            <tr>
                <td><strong>{{ $c->nom_complet }}</strong></td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->pays ?? '—' }}</td>
                <td>{{ $c->etablissement ?? '—' }}</td>
                <td>{{ $c->commandes()->count() }}</td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ route('admin.clients.show', $c) }}" class="btn btn-outline-navy btn-xs">Voir</a></td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Aucun client.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $clients->links() }}
</div>
@endsection
