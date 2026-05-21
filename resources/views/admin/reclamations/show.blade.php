@extends('layouts.dashboard')
@section('title', 'Réclamation')
@section('page-title', 'Réclamation / Suggestion')
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
