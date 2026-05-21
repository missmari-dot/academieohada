@extends('layouts.dashboard')
@section('title','Mon espace')
@section('page-title','Mon tableau de bord')
@section('sidebar-role','Espace Client')

@section('sidebar-links')
<a href="{{ route('client.dashboard') }}" class="sidebar-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
    🏠 Tableau de bord
</a>
<a href="{{ route('client.commandes') }}" class="sidebar-link {{ request()->routeIs('client.commandes*') ? 'active' : '' }}">
    📋 Mes commandes
</a>
<a href="{{ route('client.profil') }}" class="sidebar-link {{ request()->routeIs('client.profil') ? 'active' : '' }}">
    👤 Mon profil
</a>
<a href="{{ route('devis') }}" class="sidebar-link sidebar-cta">
    ⚡ Nouvelle commande
</a>
@endsection

@section('content')
<div class="dashboard-welcome">
    <h2>Bonjour {{ $user->prenom }} 👋</h2>
    <p>Voici l'état de vos commandes</p>
</div>

{{-- Stats --}}
<div class="stats-cards">
    <div class="stat-card"><span class="stat-card-number">{{ $stats['total'] }}</span><span class="stat-card-label">Total commandes</span></div>
    <div class="stat-card stat-card-orange"><span class="stat-card-number">{{ $stats['en_cours'] }}</span><span class="stat-card-label">En cours</span></div>
    <div class="stat-card stat-card-green"><span class="stat-card-number">{{ $stats['livres'] }}</span><span class="stat-card-label">Livrés</span></div>
    <div class="stat-card"><span class="stat-card-number">{{ $stats['en_attente'] }}</span><span class="stat-card-label">En attente</span></div>
</div>

{{-- Commandes récentes --}}
<div class="dashboard-section">
    <div class="section-header-row">
        <h3>Commandes récentes</h3>
        <a href="{{ route('client.commandes') }}" class="btn btn-outline-navy btn-sm">Tout voir</a>
    </div>

    @forelse($recentes as $cmd)
    <div class="commande-row">
        <div class="commande-info">
            <span class="commande-ref">{{ $cmd->reference }}</span>
            <span class="commande-service">{{ $cmd->service }} {{ $cmd->niveau ? "({$cmd->niveau})" : '' }}</span>
            <span class="commande-sujet">{{ Str::limit($cmd->sujet, 60) }}</span>
        </div>
        <div class="commande-meta">
            <span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span>
            <span class="commande-montant">{{ number_format($cmd->montant, 0, ',', ' ') }} FCFA</span>
        </div>
        <div class="commande-actions">
            @if($cmd->statut === 'livre' || $cmd->statut === 'cloture')
                <a href="{{ route('client.commandes.show', $cmd) }}" class="btn btn-green btn-sm">⬇ Télécharger</a>
            @else
                <a href="{{ route('client.commandes.show', $cmd) }}" class="btn btn-outline-navy btn-sm">Voir détail →</a>
            @endif
        </div>
    </div>
    @empty
    <div class="empty-state">
        <p>Vous n'avez pas encore de commande.</p>
        <a href="{{ route('devis') }}" class="btn btn-orange">Demander un devis →</a>
    </div>
    @endforelse
</div>

{{-- CTA --}}
<div class="dashboard-cta">
    <div class="cta-card">
        <h4>Besoin d'un nouveau service ?</h4>
        <p>Devis gratuit sous 2h · Paiement flexible</p>
        <a href="{{ route('devis') }}" class="btn btn-orange">Nouvelle commande →</a>
    </div>
    <div class="cta-card">
        <h4>Une question ?</h4>
        <p>Notre équipe vous répond sur WhatsApp</p>
        <a href="https://wa.me/221775646246" target="_blank" class="btn btn-outline-navy">💬 WhatsApp</a>
    </div>
</div>
@endsection
