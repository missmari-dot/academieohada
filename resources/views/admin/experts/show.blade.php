@extends('layouts.dashboard')
@section('title', $user->nom_complet)
@section('page-title', 'Expert — ' . $user->nom_complet)
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
<div class="detail-layout">
    <div class="detail-main">
        <div class="detail-card">
            <div class="profil-header">
                <img src="{{ $user->avatar_url }}" alt="Avatar" class="avatar-lg">
                <div><h3>{{ $user->nom_complet }}</h3><p>{{ $user->email }}</p></div>
            </div>
            <div class="detail-grid">
                <div class="detail-row"><span>Téléphone</span><span>{{ $user->telephone ?? '—' }}</span></div>
                <div class="detail-row"><span>Pays</span><span>{{ $user->pays ?? '—' }}</span></div>
                <div class="detail-row"><span>Commandes totales</span><span>{{ $commandes->count() }}</span></div>
                <div class="detail-row"><span>Livrées</span><span>{{ $commandes->where('statut','livre')->count() }}</span></div>
                <div class="detail-row"><span>Actives</span><span>{{ $commandes->whereIn('statut',['confirme','en_redaction','revision'])->count() }}</span></div>
                <div class="detail-row"><span>Statut</span><span class="badge {{ $user->actif ? 'badge-green':'badge-red' }}">{{ $user->actif ? 'Actif':'Désactivé' }}</span></div>
            </div>
        </div>
        <div class="dashboard-section">
            <h3>Commandes assignées</h3>
            @foreach($commandes->take(10) as $cmd)
            <div class="commande-row">
                <div class="commande-info">
                    <span class="commande-ref">{{ $cmd->reference }}</span>
                    <span class="commande-service">{{ $cmd->service }}</span>
                </div>
                <span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span>
                <a href="{{ route('admin.commandes.show', $cmd) }}" class="btn btn-outline-navy btn-xs">Voir</a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="detail-sidebar">
        <div class="detail-card">
            <form method="POST" action="{{ route('admin.experts.toggle', $user) }}">
                @csrf @method('PUT')
                <button type="submit" class="btn {{ $user->actif ? 'btn-outline-navy':'btn-green' }} btn-full btn-sm">
                    {{ $user->actif ? 'Désactiver le compte':'Activer le compte' }}
                </button>
            </form>
        </div>
        <a href="{{ route('admin.experts') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour experts</a>
    </div>
</div>
@endsection
