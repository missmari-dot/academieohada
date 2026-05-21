@extends('layouts.dashboard')
@section('title', $commande->reference)
@section('page-title', $commande->reference)
@section('sidebar-role','Espace Client')
@section('sidebar-links')
<a href="{{ route('client.dashboard') }}" class="sidebar-link">🏠 Tableau de bord</a>
<a href="{{ route('client.commandes') }}" class="sidebar-link active">📋 Mes commandes</a>
<a href="{{ route('client.profil') }}" class="sidebar-link">👤 Mon profil</a>
<a href="{{ route('devis') }}" class="sidebar-link sidebar-cta">⚡ Nouvelle commande</a>
@endsection

@section('content')
<div class="detail-layout">

    {{-- Informations --}}
    <div class="detail-main">
        <div class="detail-card">
            <h3>📋 Informations</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>Référence</span><strong>{{ $commande->reference }}</strong></div>
                <div class="detail-row"><span>Service</span><span>{{ $commande->service }} {{ $commande->niveau ? "({$commande->niveau})" : '' }}</span></div>
                <div class="detail-row"><span>Sujet</span><span>{{ $commande->sujet }}</span></div>
                <div class="detail-row"><span>Délai</span><span>{{ $commande->delai }}</span></div>
                <div class="detail-row"><span>Montant</span><strong>{{ number_format($commande->montant, 0, ',', ' ') }} FCFA</strong></div>
                <div class="detail-row"><span>Statut</span><span class="badge badge-{{ $commande->statut_color }}">{{ $commande->statut_label }}</span></div>
                @if($commande->expert)<div class="detail-row"><span>Expert assigné</span><span>{{ $commande->expert->nom_complet }}</span></div>@endif
                @if($commande->note_livraison)<div class="detail-row"><span>Note de l'expert</span><span>{{ $commande->note_livraison }}</span></div>@endif
            </div>
        </div>

        {{-- Timeline --}}
        <div class="detail-card">
            <h3>📍 Suivi de commande</h3>
            <div class="timeline">
                @foreach($timeline as $step)
                <div class="timeline-step timeline-{{ $step['etat'] }}">
                    <div class="timeline-dot">
                        @if($step['etat'] === 'done') ✅
                        @elseif($step['etat'] === 'current') 🔄
                        @else ○
                        @endif
                    </div>
                    <div class="timeline-content">
                        <span class="timeline-label">{{ $step['label'] }}</span>
                        @if($step['etat'] === 'current')<span class="timeline-status">En cours...</span>@endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Fichiers livrés --}}
        @if(in_array($commande->statut, ['livre','cloture']) && $commande->fichiers->count())
        <div class="detail-card">
            <h3>📂 Fichiers livrés</h3>
            @foreach($commande->fichiers as $fichier)
            <div class="fichier-row">
                <span>📄 {{ $fichier->nom_original }}</span>
                <span>{{ $fichier->created_at->format('d/m/Y') }}</span>
                <a href="{{ route('client.commandes.download', [$commande, $fichier]) }}" class="btn btn-green btn-sm">⬇ Télécharger</a>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <div class="detail-sidebar">
        <div class="detail-card">
            <h4>Besoin d'aide ?</h4>
            <p>Contactez-nous directement sur WhatsApp en mentionnant votre référence <strong>{{ $commande->reference }}</strong>.</p>
            <a href="https://wa.me/221775646246?text={{ rawurlencode('Bonjour, je vous contacte concernant ma commande '.$commande->reference) }}" target="_blank" class="btn btn-orange btn-full btn-sm">💬 Contacter sur WhatsApp</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('client.commandes') }}" class="btn btn-outline-navy btn-full btn-sm">← Mes commandes</a>
        </div>
    </div>
</div>
@endsection
