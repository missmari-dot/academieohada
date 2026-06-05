@extends('layouts.dashboard')
@section('title', 'Réclamation')
@section('page-title', 'Réclamation / Suggestion')
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
            <h3>{{ $reclamation->type === 'reclamation' ? '⚠️ Réclamation' : '💡 Suggestion' }}</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>Auteur</span><strong>{{ $reclamation->nom_complet }}</strong></div>
                <div class="detail-row"><span>Email</span><span>{{ $reclamation->email }}</span></div>
                <div class="detail-row"><span>Statut</span>
                    @if($reclamation->statut === 'nouveau')<span class="badge badge-orange">Nouveau</span>
                    @elseif($reclamation->statut === 'en_traitement')<span class="badge badge-blue">En traitement</span>
                    @else<span class="badge badge-green">Résolu</span>@endif
                </div>
            </div>
            <div class="message-body">{{ $reclamation->message }}</div>
            @if($reclamation->reponse_admin)
            <div class="admin-response"><strong>Réponse admin :</strong><p>{{ $reclamation->reponse_admin }}</p></div>
            @endif
        </div>
    </div>
    <div class="detail-sidebar">
        <div class="detail-card">
            <h4>Mettre à jour</h4>
            <form method="POST" action="{{ route('admin.reclamations.statut', $reclamation) }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Statut</label>
                    <select name="statut" class="form-select">
                        <option value="nouveau" {{ $reclamation->statut === 'nouveau' ? 'selected':'' }}>Nouveau</option>
                        <option value="en_traitement" {{ $reclamation->statut === 'en_traitement' ? 'selected':'' }}>En traitement</option>
                        <option value="resolu" {{ $reclamation->statut === 'resolu' ? 'selected':'' }}>Résolu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Réponse admin</label>
                    <textarea name="reponse_admin" rows="4" class="form-textarea">{{ $reclamation->reponse_admin }}</textarea>
                </div>
                <button type="submit" class="btn btn-orange btn-full btn-sm">Mettre à jour</button>
            </form>
        </div>
        <a href="{{ route('admin.reclamations') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour</a>
    </div>
</div>
@endsection
@push('styles')
<style>
.message-body { background: #f9fafb; border-radius: 8px; padding: 1.25rem; margin-top: 1.25rem; font-size: .9rem; line-height: 1.7; white-space: pre-wrap; }
.admin-response { background: #eff6ff; border-radius: 8px; padding: 1rem; margin-top: 1rem; border-left: 3px solid #3b82f6; }
.admin-response strong { font-size: .875rem; color: #1d4ed8; }
.admin-response p { font-size: .875rem; margin-top: .25rem; }
</style>
@endpush
