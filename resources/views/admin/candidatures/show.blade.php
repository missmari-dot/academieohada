@extends('layouts.dashboard')
@section('title', $candidature->nom_complet)
@section('page-title', 'Candidature — ' . $candidature->nom_complet)
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link active">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
<div class="detail-layout">
    <div class="detail-main">
        <div class="detail-card">
            <h3>👤 Profil du candidat</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>Nom complet</span><strong>{{ $candidature->nom_complet }}</strong></div>
                <div class="detail-row"><span>Email</span><span>{{ $candidature->email }}</span></div>
                <div class="detail-row"><span>WhatsApp</span><span>{{ $candidature->telephone }}</span></div>
                <div class="detail-row"><span>Localisation</span><span>{{ $candidature->ville }}, {{ $candidature->pays }}</span></div>
                <div class="detail-row"><span>Diplôme</span><strong>{{ $candidature->diplome }}</strong></div>
                <div class="detail-row"><span>Spécialité</span><span>{{ $candidature->specialite }}</span></div>
                <div class="detail-row"><span>Établissement</span><span>{{ $candidature->etablissement_diplome }}</span></div>
                <div class="detail-row"><span>Expérience</span><span>{{ $candidature->annees_experience }} ans</span></div>
                <div class="detail-row"><span>Disponibilité</span><span>{{ $candidature->disponibilite }}</span></div>
                @if($candidature->services_proposes)
                <div class="detail-row"><span>Services proposés</span><span>{{ implode(', ', $candidature->services_proposes) }}</span></div>
                @endif
                @if($candidature->message_libre)
                <div class="detail-row"><span>Message</span><span>{{ $candidature->message_libre }}</span></div>
                @endif
                <div class="detail-row"><span>Statut</span>
                    @if($candidature->statut === 'en_attente')<span class="badge badge-orange">En attente</span>
                    @elseif($candidature->statut === 'valide')<span class="badge badge-green">Validée</span>
                    @else<span class="badge badge-gray">Refusée @if($candidature->motif_refus)— {{ $candidature->motif_refus }}@endif</span>@endif
                </div>
            </div>
        </div>
        <div class="detail-card">
            <h3>📄 Documents</h3>
            <a href="{{ route('admin.candidatures.cv', $candidature) }}" class="btn btn-outline-navy btn-sm">⬇ Télécharger le CV</a>
            @if($candidature->lettre_path)<span class="ml-2 text-muted">Lettre disponible</span>@endif
        </div>
    </div>

    @if($candidature->statut === 'en_attente')
    <div class="detail-sidebar">
        {{-- Valider --}}
        <div class="detail-card">
            <h4>✅ Valider la candidature</h4>
            <p>Un compte expert sera créé automatiquement et un email d'accès sera envoyé.</p>
            <form method="POST" action="{{ route('admin.candidatures.valider', $candidature) }}">
                @csrf @method('PUT')
                <button type="submit" class="btn btn-green btn-full" onclick="return confirm('Valider cette candidature et créer le compte expert ?')">Valider & Créer le compte</button>
            </form>
        </div>

        {{-- Refuser --}}
        <div class="detail-card">
            <h4>❌ Refuser la candidature</h4>
            <form method="POST" action="{{ route('admin.candidatures.refuser', $candidature) }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Motif du refus (optionnel)</label>
                    <textarea name="motif_refus" rows="3" class="form-textarea" placeholder="Expliquez brièvement le motif..."></textarea>
                </div>
                <button type="submit" class="btn btn-outline-navy btn-full btn-sm" onclick="return confirm('Refuser cette candidature ?')">Refuser</button>
            </form>
        </div>

        <a href="{{ route('admin.candidatures') }}" class="btn btn-outline-navy btn-full btn-sm mt-1">← Retour liste</a>
    </div>
    @else
    <div class="detail-sidebar">
        <a href="{{ route('admin.candidatures') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour liste</a>
    </div>
    @endif
</div>
@endsection
