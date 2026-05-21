@extends('layouts.dashboard')
@section('title','Candidatures')
@section('page-title','Candidatures experts')
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link active">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
<form method="GET" class="filters-bar">
    <select name="statut" class="form-select filter-select" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected':'' }}>En attente</option>
        <option value="valide" {{ request('statut') === 'valide' ? 'selected':'' }}>Validées</option>
        <option value="refuse" {{ request('statut') === 'refuse' ? 'selected':'' }}>Refusées</option>
    </select>
</form>
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Nom</th><th>Email</th><th>Spécialité</th><th>Diplôme</th><th>Expérience</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($candidatures as $c)
            <tr>
                <td><strong>{{ $c->nom_complet }}</strong></td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->specialite }}</td>
                <td>{{ $c->diplome }}</td>
                <td>{{ $c->annees_experience }} ans</td>
                <td>
                    @if($c->statut === 'en_attente')<span class="badge badge-orange">En attente</span>
                    @elseif($c->statut === 'valide')<span class="badge badge-green">Validée</span>
                    @else<span class="badge badge-gray">Refusée</span>@endif
                </td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ route('admin.candidatures.show', $c) }}" class="btn btn-outline-navy btn-xs">Examiner</a></td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Aucune candidature.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $candidatures->links() }}
</div>
@endsection
