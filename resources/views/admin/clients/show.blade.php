@extends('layouts.dashboard')
@section('title', $user->nom_complet)
@section('page-title', $user->nom_complet)
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active':'' }}">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link {{ request()->routeIs('admin.commandes*') ? 'active':'' }}">📋 Commandes @if(isset($badges['devis']) && $badges['devis'])<span class="badge-pill">{{ $badges['devis'] }}</span>@endif</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link {{ request()->routeIs('admin.candidatures*') ? 'active':'' }}">👤 Candidatures @if(isset($badges['candidatures']) && $badges['candidatures'])<span class="badge-pill">{{ $badges['candidatures'] }}</span>@endif</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active':'' }}">✉️ Messages @if(isset($badges['messages']) && $badges['messages'])<span class="badge-pill">{{ $badges['messages'] }}</span>@endif</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link {{ request()->routeIs('admin.reclamations*') ? 'active':'' }}">⚠️ Réclamations @if(isset($badges['reclamations']) && $badges['reclamations'])<span class="badge-pill">{{ $badges['reclamations'] }}</span>@endif</a>
<a href="{{ route('admin.clients.index') }}" class="sidebar-link {{ request()->routeIs('admin.clients*') ? 'active':'' }}">👥 Clients</a>
<a href="{{ route('admin.experts.index') }}" class="sidebar-link {{ request()->routeIs('admin.experts*') ? 'active':'' }}">🎓 Experts</a>
<a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active':'' }}">⚙️ Administrateurs</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link {{ request()->routeIs('admin.statistiques') ? 'active':'' }}">📈 Statistiques</a>
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
        <div class="detail-card">
            <h4>⚙️ Actions</h4>
            <a href="{{ route('admin.clients.edit', $user) }}" class="btn btn-outline-navy btn-full btn-sm mb-2">✏️ Modifier</a>
            
            <form method="POST" action="{{ route('admin.clients.toggle-bloque', $user) }}" onsubmit="return confirm('Voulez-vous vraiment {{ $user->actif ? 'bloquer' : 'débloquer' }} ce client ?');">
                @csrf @method('PUT')
                <button type="submit" class="btn {{ $user->actif ? 'btn-red' : 'btn-green' }} btn-full btn-sm mb-2">
                    {{ $user->actif ? '🚫 Bloquer le compte' : '✅ Débloquer le compte' }}
                </button>
            </form>

            <form method="POST" action="{{ route('admin.clients.destroy', $user) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ? Cette action est irréversible.');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-red btn-full btn-sm text-red mb-2" style="border-color: var(--red); color: var(--red);">🗑️ Supprimer</button>
            </form>
        </div>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour clients</a>
    </div>
</div>
@endsection
