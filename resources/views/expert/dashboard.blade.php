{{-- resources/views/expert/dashboard.blade.php --}}
@extends('layouts.dashboard')
@section('title','Espace Expert')
@section('page-title','Mon espace expert')
@section('sidebar-role','Espace Expert')
@section('sidebar-links')
<a href="{{ route('expert.dashboard') }}" class="sidebar-link {{ request()->routeIs('expert.dashboard') ? 'active':'' }}">🏠 Dashboard</a>
<a href="{{ route('expert.commandes') }}" class="sidebar-link {{ request()->routeIs('expert.commandes*') ? 'active':'' }}">📋 Mes commandes</a>
<a href="{{ route('expert.profil') }}" class="sidebar-link {{ request()->routeIs('expert.profil') ? 'active':'' }}">👤 Mon profil</a>
@endsection
@section('content')
<div class="dashboard-welcome"><h2>Bonjour {{ $user->prenom }} 👋</h2><p>Voici vos commandes assignées.</p></div>

<div class="stats-cards">
    <div class="stat-card stat-card-orange"><span class="stat-card-number">{{ $stats['actives'] }}</span><span class="stat-card-label">Commandes actives</span></div>
    <div class="stat-card stat-card-green"><span class="stat-card-number">{{ $stats['livrees_mois'] }}</span><span class="stat-card-label">Livrées ce mois</span></div>
    <div class="stat-card"><span class="stat-card-number">{{ $stats['note_moyenne'] }}/5</span><span class="stat-card-label">Note moyenne</span></div>
</div>

<div class="dashboard-section">
    <h3>📋 Commandes assignées</h3>
    @forelse($actives as $cmd)
    <div class="commande-row">
        <div class="commande-info">
            <span class="commande-ref">{{ $cmd->reference }}</span>
            <span class="commande-service">{{ $cmd->service }} — {{ $cmd->client?->nom_complet }}</span>
            <span class="commande-sujet">{{ Str::limit($cmd->sujet, 60) }}</span>
        </div>
        <div class="commande-meta">
            <span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span>
            @if($cmd->date_soutenance)
            <span class="delai-warning {{ $cmd->jours_restants < 5 ? 'text-red' : '' }}">
                ⏰ {{ $cmd->jours_restants }} jours restants
            </span>
            @endif
        </div>
        <div class="commande-actions">
            <a href="{{ route('expert.commandes.show', $cmd) }}" class="btn btn-orange btn-sm">Livrer →</a>
        </div>
    </div>
    @empty
    <div class="empty-state"><p>Aucune commande active pour le moment.</p></div>
    @endforelse
</div>
@endsection
