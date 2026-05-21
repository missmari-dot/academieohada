@extends('layouts.dashboard')
@section('title', $commande->reference)
@section('page-title', 'Commande ' . $commande->reference)
@section('sidebar-role','Espace Expert')
@section('sidebar-links')
<a href="{{ route('expert.dashboard') }}" class="sidebar-link">🏠 Dashboard</a>
<a href="{{ route('expert.commandes') }}" class="sidebar-link active">📋 Mes commandes</a>
<a href="{{ route('expert.profil') }}" class="sidebar-link">👤 Mon profil</a>
@endsection
@section('content')
<div class="detail-layout">
    <div class="detail-main">
        <div class="detail-card">
            <h3>📋 Détails de la commande</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>Référence</span><strong>{{ $commande->reference }}</strong></div>
                <div class="detail-row"><span>Client</span><span>{{ $commande->client?->nom_complet }}</span></div>
                <div class="detail-row"><span>Service</span><span>{{ $commande->service }} {{ $commande->niveau ? "({$commande->niveau})" : '' }}</span></div>
                <div class="detail-row"><span>Sujet</span><strong>{{ $commande->sujet }}</strong></div>
                @if($commande->filiere)<div class="detail-row"><span>Filière</span><span>{{ $commande->filiere }}</span></div>@endif
                @if($commande->parties)<div class="detail-row"><span>Parties</span><span>{{ implode(', ', $commande->parties) }}</span></div>@endif
                <div class="detail-row"><span>Délai</span><span>{{ $commande->delai }}</span></div>
                @if($commande->date_soutenance)<div class="detail-row"><span>Soutenance</span><span>{{ $commande->date_soutenance->format('d/m/Y') }}</span></div>@endif
                @if($commande->instructions)<div class="detail-row"><span>Instructions</span><span>{{ $commande->instructions }}</span></div>@endif
                <div class="detail-row"><span>Statut</span><span class="badge badge-{{ $commande->statut_color }}">{{ $commande->statut_label }}</span></div>
            </div>
        </div>

        {{-- Formulaire de livraison --}}
        @if(in_array($commande->statut, ['confirme','en_redaction','revision']))
        <div class="detail-card">
            <h3>✅ Livrer la commande</h3>
            @if($errors->any())<div class="alert alert-error">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>@endif
            <form method="POST" action="{{ route('expert.commandes.livrer', $commande) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Fichier PDF * (max 20 Mo)</label>
                    <input type="file" name="fichier_pdf" required accept=".pdf" class="form-input">
                </div>
                <div class="form-group">
                    <label>Fichier DOCX * (max 20 Mo)</label>
                    <input type="file" name="fichier_docx" required accept=".doc,.docx" class="form-input">
                </div>
                <div class="form-group">
                    <label>Note pour le client (optionnel)</label>
                    <textarea name="note" rows="3" class="form-textarea" placeholder="Instructions de lecture, remarques..."></textarea>
                </div>
                <button type="submit" class="btn btn-green btn-lg" onclick="return confirm('Marquer cette commande comme livrée ? Le client sera notifié.')">
                    ✅ Marquer comme livré
                </button>
            </form>
        </div>
        @elseif($commande->statut === 'livre')
        <div class="detail-card">
            <div class="alert alert-success">✅ Cette commande a été livrée.</div>
        </div>
        @endif
    </div>

    <div class="detail-sidebar">
        <div class="detail-card">
            <h4>📱 Contact client</h4>
            <p>{{ $commande->client?->email }}</p>
            @if($commande->client?->telephone)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $commande->client->telephone) }}" target="_blank" class="btn btn-outline-navy btn-full btn-sm mt-1">💬 WhatsApp</a>
            @endif
        </div>
        <a href="{{ route('expert.commandes') }}" class="btn btn-outline-navy btn-full btn-sm mt-2">← Mes commandes</a>
    </div>
</div>
@endsection
