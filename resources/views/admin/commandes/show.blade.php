@extends('layouts.dashboard')
@section('title', $commande->reference)
@section('page-title', 'Commande ' . $commande->reference)
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link active">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
<div class="detail-layout">
    <div class="detail-main">
        {{-- Infos commande --}}
        <div class="detail-card">
            <h3>📋 Détails</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>Référence</span><strong>{{ $commande->reference }}</strong></div>
                <div class="detail-row"><span>Client</span><span>{{ $commande->client?->nom_complet }} — {{ $commande->client?->email }}</span></div>
                <div class="detail-row"><span>Service</span><span>{{ $commande->service }} {{ $commande->niveau ? "({$commande->niveau})" : '' }}</span></div>
                <div class="detail-row"><span>Sujet</span><span>{{ $commande->sujet }}</span></div>
                @if($commande->filiere)<div class="detail-row"><span>Filière</span><span>{{ $commande->filiere }}</span></div>@endif
                <div class="detail-row"><span>Délai</span><span>{{ $commande->delai }}</span></div>
                @if($commande->date_soutenance)<div class="detail-row"><span>Soutenance</span><span>{{ $commande->date_soutenance->format('d/m/Y') }}</span></div>@endif
                <div class="detail-row"><span>Montant</span><strong>{{ number_format($commande->montant, 0, ',', ' ') }} FCFA</strong></div>
                <div class="detail-row"><span>Paiement</span><span>{{ $commande->mode_paiement ?? '—' }}</span></div>
                @if($commande->instructions)<div class="detail-row"><span>Instructions</span><span>{{ $commande->instructions }}</span></div>@endif
                @if($commande->parties)<div class="detail-row"><span>Parties</span><span>{{ implode(', ', $commande->parties) }}</span></div>@endif
                @if($commande->options)<div class="detail-row"><span>Options</span><span>{{ implode(', ', $commande->options) }}</span></div>@endif
                <div class="detail-row"><span>Statut actuel</span><span class="badge badge-{{ $commande->statut_color }}">{{ $commande->statut_label }}</span></div>
                @if($commande->expert)<div class="detail-row"><span>Expert assigné</span><span>{{ $commande->expert->nom_complet }}</span></div>@endif
            </div>
        </div>

        {{-- Fichiers livrés --}}
        @if($commande->fichiers->count())
        <div class="detail-card">
            <h3>📂 Fichiers livrés</h3>
            @foreach($commande->fichiers as $f)
            <div class="fichier-row">
                <span>📄 {{ $f->nom_original }}</span>
                <span>{{ $f->created_at->format('d/m/Y H:i') }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="detail-sidebar">
        {{-- Changer statut --}}
        <div class="detail-card">
            <h4>🔄 Changer le statut</h4>
            <form method="POST" action="{{ route('admin.commandes.statut', $commande) }}">
                @csrf @method('PUT')
                <select name="statut" class="form-select mb-2">
                    @foreach($statuts as $key => $s)
                    <option value="{{ $key }}" {{ $commande->statut === $key ? 'selected':'' }}>{{ $s['label'] }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-orange btn-full btn-sm">Mettre à jour</button>
            </form>
        </div>

        {{-- Assigner expert --}}
        <div class="detail-card">
            <h4>🎓 Assigner un expert</h4>
            <form method="POST" action="{{ route('admin.commandes.assigner', $commande) }}">
                @csrf @method('PUT')
                <select name="expert_id" class="form-select mb-2">
                    <option value="">-- Choisir un expert --</option>
                    @foreach($experts as $e)
                    <option value="{{ $e->id }}" {{ $commande->expert_id === $e->id ? 'selected':'' }}>
                        {{ $e->nom_complet }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-navy btn-full btn-sm">Assigner</button>
            </form>
        </div>

        {{-- Contact client --}}
        @if($commande->client)
        <div class="detail-card">
            <h4>📱 Contacter le client</h4>
            <p>{{ $commande->client->email }}</p>
            <p>{{ $commande->client->telephone }}</p>
            @if($commande->client->telephone)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $commande->client->telephone) }}?text={{ rawurlencode('Bonjour, concernant votre commande '.$commande->reference.' — AcadémieOHADA') }}" target="_blank" class="btn btn-outline-navy btn-full btn-sm mt-1">💬 WhatsApp</a>
            @endif
        </div>
        @endif

        <a href="{{ route('admin.commandes') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour liste</a>
    </div>
</div>
@endsection
