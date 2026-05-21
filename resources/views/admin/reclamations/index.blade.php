@extends('layouts.dashboard')
@section('title','Réclamations')
@section('page-title','Réclamations & Suggestions')
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link active">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Auteur</th><th>Type</th><th>Message</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($reclamations as $r)
            <tr>
                <td>{{ $r->nom_complet }}</td>
                <td><span class="badge {{ $r->type === 'reclamation' ? 'badge-red':'badge-blue' }}">{{ ucfirst($r->type) }}</span></td>
                <td>{{ Str::limit($r->message, 60) }}</td>
                <td>
                    @if($r->statut === 'nouveau')<span class="badge badge-orange">Nouveau</span>
                    @elseif($r->statut === 'en_traitement')<span class="badge badge-blue">En traitement</span>
                    @else<span class="badge badge-green">Résolu</span>@endif
                </td>
                <td>{{ $r->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ route('admin.reclamations.show', $r) }}" class="btn btn-outline-navy btn-xs">Traiter</a></td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Aucune réclamation.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $reclamations->links() }}
</div>
@endsection
