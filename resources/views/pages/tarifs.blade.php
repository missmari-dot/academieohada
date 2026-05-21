@extends('layouts.app')
@section('title', 'Tarifs')
@section('description', 'Grille tarifaire AcadémieOHADA — Mémoires Master et Licence, correction, accompagnement, délais.')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-badge">Transparent & sans surprise</span>
        <h1>Nos tarifs</h1>
        <p>Payez par partie ou commandez le mémoire complet et économisez.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        {{-- Toggle Master / Licence --}}
        <div class="tarifs-toggle">
            <button class="toggle-btn active" id="btn-master" onclick="switchNiveau('master')">
                🎓 Master (80 pages)
            </button>
            <button class="toggle-btn" id="btn-licence" onclick="switchNiveau('licence')">
                📘 Licence (50 pages)
            </button>
        </div>

        {{-- Grille Master --}}
        <div id="tarifs-master">
            <div class="tarifs-grid">
                @foreach($tarifsMaster as $t)
                <div class="tarif-card {{ isset($t['highlight']) ? 'tarif-highlight' : '' }}">
                    <div class="tarif-label">{{ $t['label'] }}</div>
                    <div class="tarif-price">{{ number_format($t['prix'], 0, ',', ' ') }} <span>FCFA</span></div>
                    @if(isset($t['economie']))
                        <div class="tarif-economy">Économie {{ number_format($t['economie'], 0, ',', ' ') }} FCFA</div>
                    @endif
                    <a href="{{ route('devis') }}" class="btn {{ isset($t['highlight']) ? 'btn-orange' : 'btn-outline-navy' }} btn-sm">
                        Commander
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Grille Licence --}}
        <div id="tarifs-licence" style="display:none">
            <div class="tarifs-grid">
                @foreach($tarifsLicence as $t)
                <div class="tarif-card {{ isset($t['highlight']) ? 'tarif-highlight' : '' }}">
                    <div class="tarif-label">{{ $t['label'] }}</div>
                    <div class="tarif-price">{{ number_format($t['prix'], 0, ',', ' ') }} <span>FCFA</span></div>
                    @if(isset($t['economie']))
                        <div class="tarif-economy">Économie {{ number_format($t['economie'], 0, ',', ' ') }} FCFA</div>
                    @endif
                    <a href="{{ route('devis') }}" class="btn {{ isset($t['highlight']) ? 'btn-orange' : 'btn-outline-navy' }} btn-sm">
                        Commander
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Modificateurs de délai --}}
        <div class="section-header mt-5">
            <h2 class="section-title">Modificateurs de délai</h2>
            <p class="section-subtitle">Le délai sélectionné ajuste automatiquement le prix final.</p>
        </div>
        <div class="delai-grid">
            @foreach($modificateurs as $m)
            <div class="delai-card delai-{{ $m['classe'] }}">
                <span class="delai-label">{{ $m['delai'] }}</span>
                <span class="delai-mod">{{ $m['mod'] }}</span>
            </div>
            @endforeach
        </div>

        {{-- Autres services --}}
        <div class="section-header mt-5">
            <h2 class="section-title">Autres prestations</h2>
        </div>
        <div class="autres-tarifs">
            <div class="autres-col">
                <h3>Rédaction</h3>
                <div class="tarif-row"><span>Rapport de stage</span><span>Sur devis</span></div>
                <div class="tarif-row"><span>Dissertation</span><span>5 000 FCFA</span></div>
                <div class="tarif-row"><span>CV + Lettre de motivation</span><span>5 000 FCFA</span></div>
                <div class="tarif-row"><span>Flyers / Affiches</span><span>Sur devis</span></div>
            </div>
            <div class="autres-col">
                <h3>Correction & Accompagnement</h3>
                <div class="tarif-row"><span>Correction / partie</span><span>10 000 FCFA</span></div>
                <div class="tarif-row"><span>Formation méthodologie</span><span>15 000 FCFA / séance</span></div>
                <div class="tarif-row"><span>Accompagnement (1h)</span><span>5 000 FCFA</span></div>
                <div class="tarif-row"><span>Séance Google Meet</span><span>5 000 FCFA / h</span></div>
                <div class="tarif-row"><span>PowerPoint soutenance</span><span>5 000 FCFA</span></div>
                <div class="tarif-row tarif-offert"><span>Suivi à la soutenance</span><span>🎁 OFFERT</span></div>
            </div>
            <div class="autres-col">
                <h3>Paiement accepté</h3>
                <div class="payment-methods">
                    <span class="payment-badge">Wave</span>
                    <span class="payment-badge">Orange Money</span>
                    
                </div>
                <p class="mt-2">Paiement possible en 2 fois ou par partie.</p>
            </div>
        </div>

    </div>
</section>

<section class="cta-section">
    <div class="container cta-inner">
        <h2>Besoin d'un devis personnalisé ?</h2>
        <p>Réponse garantie en moins de 2h.</p>
        <a href="{{ route('devis') }}" class="btn btn-orange btn-lg">Obtenir mon devis →</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
function switchNiveau(niveau) {
    document.getElementById('tarifs-master').style.display  = niveau === 'master'  ? 'block' : 'none';
    document.getElementById('tarifs-licence').style.display = niveau === 'licence' ? 'block' : 'none';
    document.getElementById('btn-master').classList.toggle('active',  niveau === 'master');
    document.getElementById('btn-licence').classList.toggle('active', niveau === 'licence');
}
</script>
@endpush
