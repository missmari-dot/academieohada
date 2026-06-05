@extends('layouts.dashboard')
@section('title', $user->nom_complet)
@section('page-title', 'Utilisateur : ' . $user->nom_complet)
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
                <div class="detail-row"><span>Rôle</span>
                    <span>
                        @foreach($user->roles as $role)
                            <span class="badge badge-gray">{{ ucfirst($role->name) }}</span>
                        @endforeach
                    </span>
                </div>
                <div class="detail-row"><span>Inscrit le</span><span>{{ $user->created_at->format('d/m/Y H:i') }}</span></div>
                <div class="detail-row"><span>Statut</span><span class="badge {{ $user->actif ? 'badge-green':'badge-red' }}">{{ $user->actif ? 'Actif':'Bloqué' }}</span></div>
            </div>
        </div>
    </div>
    <div class="detail-sidebar">
        <div class="detail-card">
            <h4>⚙️ Actions</h4>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-navy btn-full btn-sm mb-2">✏️ Modifier</a>
            
            @if($user->id !== auth()->id())
            <form method="POST" action="{{ route('admin.users.toggle-bloque', $user) }}" onsubmit="return confirm('Voulez-vous vraiment {{ $user->actif ? 'bloquer' : 'débloquer' }} cet utilisateur ?');">
                @csrf @method('PUT')
                <button type="submit" class="btn {{ $user->actif ? 'btn-red' : 'btn-green' }} btn-full btn-sm mb-2">
                    {{ $user->actif ? '🚫 Bloquer le compte' : '✅ Débloquer le compte' }}
                </button>
            </form>

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ? Cette action est irréversible.');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-red btn-full btn-sm text-red mb-2" style="border-color: var(--red); color: var(--red);">🗑️ Supprimer</button>
            </form>
            @endif
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour utilisateurs</a>
    </div>
</div>
@endsection
