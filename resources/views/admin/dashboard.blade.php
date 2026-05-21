@extends('layouts.dashboard')
@section('title','Administration')
@section('page-title','Dashboard Admin')
@section('sidebar-role','Administration')

@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active':'' }}">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link {{ request()->routeIs('admin.commandes*') ? 'active':'' }}">📋 Commandes @if($badges['devis'])<span class="badge-pill">{{ $badges['devis'] }}</span>@endif</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link {{ request()->routeIs('admin.candidatures*') ? 'active':'' }}">👤 Candidatures @if($badges['candidatures'])<span class="badge-pill">{{ $badges['candidatures'] }}</span>@endif</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active':'' }}">✉️ Messages @if($badges['messages'])<span class="badge-pill">{{ $badges['messages'] }}</span>@endif</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link {{ request()->routeIs('admin.reclamations*') ? 'active':'' }}">⚠️ Réclamations @if($badges['reclamations'])<span class="badge-pill">{{ $badges['reclamations'] }}</span>@endif</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link {{ request()->routeIs('admin.clients*') ? 'active':'' }}">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link {{ request()->routeIs('admin.experts*') ? 'active':'' }}">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link {{ request()->routeIs('admin.statistiques') ? 'active':'' }}">📈 Statistiques</a>
@endsection

@section('content')

{{-- Stats principales --}}
<div class="stats-cards stats-cards-4">
    <div class="stat-card"><span class="stat-card-number">{{ $stats['commandes'] }}</span><span class="stat-card-label">Commandes totales</span></div>
    <div class="stat-card"><span class="stat-card-number">{{ $stats['clients'] }}</span><span class="stat-card-label">Clients inscrits</span></div>
    <div class="stat-card stat-card-green"><span class="stat-card-number">{{ $stats['experts_actifs'] }}</span><span class="stat-card-label">Experts actifs</span></div>
    <div class="stat-card {{ $stats['a_traiter'] > 0 ? 'stat-card-red' : '' }}"><span class="stat-card-number">{{ $stats['a_traiter'] }}</span><span class="stat-card-label">À traiter 🔴</span></div>
</div>

{{-- Notifications --}}
@if($notifications->count())
<div class="dashboard-section">
    <div class="section-header-row">
        <h3>🔔 Notifications récentes</h3>
        <form method="POST" action="{{ route('admin.notifications.lire-tout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-navy btn-xs">Tout marquer lu</button>
        </form>
    </div>
    @foreach($notifications as $notif)
    <a href="{{ $notif->lien ?: '#' }}" class="notif-row {{ !$notif->lu ? 'notif-unread' : '' }}">
        <span class="notif-type notif-{{ $notif->type }}">
            @switch($notif->type)
                @case('devis') 📋 @break
                @case('message') ✉️ @break
                @case('candidature') 👤 @break
                @case('reclamation') ⚠️ @break
                @case('client') 🧑 @break
                @default 🔔
            @endswitch
        </span>
        <div class="notif-content">
            <strong>{{ $notif->titre }}</strong>
            <p>{{ $notif->contenu }}</p>
        </div>
        <span class="notif-time">{{ $notif->created_at->diffForHumans() }}</span>
    </a>
    @endforeach
</div>
@endif

{{-- Dernières commandes --}}
<div class="dashboard-section">
    <div class="section-header-row">
        <h3>📋 Dernières commandes</h3>
        <a href="{{ route('admin.commandes') }}" class="btn btn-outline-navy btn-sm">Tout voir</a>
    </div>
    <div class="table-wrapper">
        <table class="data-table">
            <thead><tr><th>Réf.</th><th>Client</th><th>Service</th><th>Montant</th><th>Statut</th><th>Date</th><th>Action</th></tr></thead>
            <tbody>
                @foreach($commandes as $cmd)
                <tr>
                    <td><strong>{{ $cmd->reference }}</strong></td>
                    <td>{{ $cmd->client?->nom_complet ?? 'N/A' }}</td>
                    <td>{{ $cmd->service }}</td>
                    <td>{{ number_format($cmd->montant, 0, ',', ' ') }} F</td>
                    <td><span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span></td>
                    <td>{{ $cmd->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ route('admin.commandes.show', $cmd) }}" class="btn btn-outline-navy btn-xs">Gérer</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
