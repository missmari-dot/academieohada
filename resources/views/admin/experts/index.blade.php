@extends('layouts.dashboard')
@section('title','Experts')
@section('page-title','Experts actifs')
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link active">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
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
                <td class="flex gap-1">
                    <a href="{{ route('admin.experts.show', $e) }}" class="btn btn-outline-navy btn-xs">Voir</a>
                    <form method="POST" action="{{ route('admin.experts.toggle', $e) }}" style="display:inline">
                        @csrf @method('PUT')
                        <button type="submit" class="btn btn-xs {{ $e->actif ? 'btn-outline-navy':'btn-green' }}">{{ $e->actif ? 'Désactiver':'Activer' }}</button>
                    </form>
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
