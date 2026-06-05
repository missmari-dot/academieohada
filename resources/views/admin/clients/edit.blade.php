@extends('layouts.dashboard')
@section('title', 'Modifier ' . $user->nom_complet)
@section('page-title', 'Modifier le client : ' . $user->nom_complet)
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
<div class="dashboard-section" style="max-width: 600px; margin: 0 auto;">
    <form method="POST" action="{{ route('admin.clients.update', $user) }}" class="form-container">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">Prénom *</label>
            <input type="text" name="prenom" class="form-input" value="{{ old('prenom', $user->prenom) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Nom *</label>
            <input type="text" name="nom" class="form-input" value="{{ old('nom', $user->nom) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-input" value="{{ old('telephone', $user->telephone) }}">
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
        <h4 style="margin-bottom: 10px;">Changer le mot de passe (optionnel)</h4>

        <div class="form-group">
            <label class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" class="form-input" minlength="8">
            <small style="color: #666; font-size: 0.8rem;">Laissez vide pour conserver le mot de passe actuel.</small>
        </div>

        <div class="form-group">
            <label class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" class="form-input" minlength="8">
        </div>

        <div class="form-actions" style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit" class="btn btn-orange">Enregistrer les modifications</button>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-navy">Annuler</a>
        </div>
    </form>
</div>
@endsection
