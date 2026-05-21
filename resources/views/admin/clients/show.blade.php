@extends('layouts.dashboard')
@section('title', $user->nom_complet)
@section('page-title', $user->nom_complet)
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
                <div class="detail-row"><span>Établissement</span><span>{{ $user->etablissement ?? '—' }}</span></div>
                <div class="detail-row"><span>Niveau</span><span>{{ $user->niveau_etudes ?? '—' }}</span></div>
                <div class="detail-row"><span>Inscrit le</span><span>{{ $user->created_at->format('d/m/Y') }}</span></div>
                <div class="detail-row"><span>Statut</span><span class="{{ $user->actif ? 'badge badge-green':'badge badge-red' }}">{{ $user->actif ? 'Actif':'Désactivé' }}</span></div>
            </div>
        </div>
        <div class="dashboard-section">
            <h3>Commandes ({{ $commandes->count() }})</h3>
            @foreach($commandes as $cmd)
            <div class="commande-row">
                <div class="commande-info">
                    <span class="commande-ref">{{ $cmd->reference }}</span>
                    <span class="commande-service">{{ $cmd->service }}</span>
                    <span class="commande-sujet">{{ Str::limit($cmd->sujet, 60) }}</span>
                </div>
                <div class="commande-meta">
                    <span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span>
                    <span>{{ number_format($cmd->montant, 0, ',', ' ') }} FCFA</span>
                </div>
                <a href="{{ route('admin.commandes.show', $cmd) }}" class="btn btn-outline-navy btn-xs">Voir</a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="detail-sidebar">
        <a href="{{ route('admin.clients') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour clients</a>
    </div>
</div>
@endsection
