@extends('layouts.app')
@section('title', 'Nos Services')
@section('description', 'Tous les services AcadémieOHADA : rédaction mémoires, correction, accompagnement, formation méthodologie.')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-badge">Expertise académique</span>
        <h1>Nos Services</h1>
        <p>De la rédaction complète à la correction, en passant par la formation : tout ce dont vous avez besoin pour réussir.</p>
    </div>
</section>

{{-- ═══ MÉMOIRES ════════════════════════════════════════════════════════════ --}}
<section class="section" id="memoires">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Service phare</span>
            <h2 class="section-title">Rédaction de Mémoires</h2>
            <p class="section-subtitle">Payez par partie ou commandez le mémoire complet et économisez jusqu'à 25 000 FCFA.</p>
        </div>
        <div class="services-detail-grid">
            <div class="service-detail-card">
                <div class="service-detail-header">
                    <h3>🎓 Master (80 pages)</h3>
                    <span class="service-detail-price">Complet : 100 000 FCFA</span>
                </div>
                <div class="service-detail-body">
                    @foreach([['Choix du sujet','5 000'],['Problématique & hypothèses','8 000'],['Plan détaillé','5 000'],['Méthodologie','10 000'],['Introduction','25 000'],['1ère Partie','50 000'],['2ème Partie','50 000'],['Conclusion','10 000']] as $row)
                    <div class="service-detail-row">
                        <span>{{ $row[0] }}</span>
                        <strong>{{ $row[1] }} FCFA</strong>
                    </div>
                    @endforeach
                    <div class="service-detail-row service-detail-free">
                        <span>Suivi & accompagnement soutenance</span>
                        <strong>🎁 OFFERT</strong>
                    </div>
                </div>
                <a href="{{ route('devis') }}?niveau=Master" class="btn btn-orange btn-full mt-2">Commander →</a>
            </div>

            <div class="service-detail-card">
                <div class="service-detail-header">
                    <h3>📘 Licence (50 pages)</h3>
                    <span class="service-detail-price">Complet : 60 000 FCFA</span>
                </div>
                <div class="service-detail-body">
                    @foreach([['Choix du sujet','3 000'],['Problématique & hypothèses','5 000'],['Plan détaillé','3 000'],['Méthodologie','7 000'],['Introduction','15 000'],['1ère Partie','30 000'],['2ème Partie','30 000'],['Conclusion','7 000']] as $row)
                    <div class="service-detail-row">
                        <span>{{ $row[0] }}</span>
                        <strong>{{ $row[1] }} FCFA</strong>
                    </div>
                    @endforeach
                    <div class="service-detail-row service-detail-free">
                        <span>Suivi & accompagnement soutenance</span>
                        <strong>🎁 OFFERT</strong>
                    </div>
                </div>
                <a href="{{ route('devis') }}?niveau=Licence" class="btn btn-orange btn-full mt-2">Commander →</a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ RÉDACTION ═══════════════════════════════════════════════════════════ --}}
<section class="section section-alt" id="redaction">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Rédaction</span>
            <h2 class="section-title">Autres prestations de rédaction</h2>
        </div>
        <div class="services-grid">
            @foreach([
                ['📝','Rapport de stage','Rapport professionnel structuré selon les normes de votre établissement.','Sur devis','rapport'],
                ['📄','Dissertation','Dissertation académique argumentée, plan détaillé inclus.','5 000 FCFA','dissertation'],
                ['💼','CV + Lettre de motivation','En français ou en anglais, adapté au profil souhaité.','5 000 FCFA','cv'],
                ['🎨','Flyers / Affiches / Cartes de visite','Supports visuels professionnels pour votre communication.','Sur devis','flyers'],
            ] as $s)
            <div class="service-card" id="{{ $s[4] }}">
                <div class="service-icon">{{ $s[0] }}</div>
                <h3>{{ $s[1] }}</h3>
                <p>{{ $s[2] }}</p>
                <p class="service-price">{{ $s[3] }}</p>
                <a href="{{ route('devis') }}" class="service-link">Demander un devis →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ CORRECTION ══════════════════════════════════════════════════════════ --}}
<section class="section" id="correction">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Qualité</span>
            <h2 class="section-title">Correction & Relecture</h2>
            <p class="section-subtitle">Vos travaux relus et corrigés par des experts, conformément aux normes OHADA, UEMOA et CEDEAO.</p>
        </div>
        <div class="services-grid">
            @foreach([
                ['✏️','Correction orthographique & grammaticale','Vérification complète de l\'orthographe, grammaire et ponctuation.','10 000 FCFA / partie'],
                ['✍️','Reformulation & amélioration du style','Réécriture fluide et académique de votre contenu.','10 000 FCFA / partie'],
                ['📜','Mise en conformité normes OHADA/UEMOA/CEDEAO','Adaptation aux normes réglementaires et académiques en vigueur.','Inclus'],
            ] as $s)
            <div class="service-card">
                <div class="service-icon">{{ $s[0] }}</div>
                <h3>{{ $s[1] }}</h3>
                <p>{{ $s[2] }}</p>
                <p class="service-price">{{ $s[3] }}</p>
                <a href="{{ route('devis') }}" class="service-link">Demander un devis →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ FORMATION & ACCOMPAGNEMENT ══════════════════════════════════════════ --}}
<section class="section section-alt" id="formation">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Accompagnement personnalisé</span>
            <h2 class="section-title">Formation & Accompagnement</h2>
        </div>
        <div class="services-grid">
            @foreach([
                ['🎓','Formation en méthodologie de recherche','Apprenez les bases de la recherche académique, structuration et rédaction scientifique.','15 000 FCFA / séance','formation'],
                ['👤','Accompagnement personnalisé (1h)','Séance individuelle pour répondre à vos questions et orienter votre travail.','5 000 FCFA','accompagnement'],
                ['📹','Séance Google Meet','Consultation vidéo avec un expert pour avancer concrètement sur votre sujet.','5 000 FCFA / heure','meet'],
                ['🏆','Suivi à la soutenance','Préparation intensive, entraînement questions jury, conseils présentation.','🎁 OFFERT avec tout mémoire complet','suivi'],
            ] as $s)
            <div class="service-card" id="{{ $s[4] }}">
                <div class="service-icon">{{ $s[0] }}</div>
                <h3>{{ $s[1] }}</h3>
                <p>{{ $s[2] }}</p>
                <p class="service-price">{{ $s[3] }}</p>
                <a href="{{ route('devis') }}" class="service-link">Réserver →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ SUPPORTS VISUELS ═════════════════════════════════════════════════════ --}}
<section class="section" id="powerpoint">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Supports visuels</span>
            <h2 class="section-title">Présentation & Visuels</h2>
        </div>
        <div class="services-grid">
            @foreach([
                ['📊','PowerPoint soutenance','Présentation professionnelle adaptée à votre mémoire, jury et filière.','5 000 FCFA'],
                ['🎨','Flyers professionnels','Design moderne pour vos événements ou campagnes de communication.','Sur devis'],
                ['📋','Affiches','Affiches grand format pour conférences, séminaires, campagnes.','Sur devis'],
                ['💳','Cartes de visite','Design professionnel, prêt à imprimer.','Sur devis'],
            ] as $s)
            <div class="service-card">
                <div class="service-icon">{{ $s[0] }}</div>
                <h3>{{ $s[1] }}</h3>
                <p>{{ $s[2] }}</p>
                <p class="service-price">{{ $s[3] }}</p>
                <a href="{{ route('devis') }}" class="service-link">Demander un devis →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container cta-inner">
        <h2>Prêt à démarrer ?</h2>
        <p>Devis gratuit en moins de 2h. Sans engagement.</p>
        <a href="{{ route('devis') }}" class="btn btn-orange btn-lg">Obtenir mon devis →</a>
    </div>
</section>

@endsection

@push('styles')
<style>
.services-detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
.service-detail-card  { border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; }
.service-detail-header{ background: #1a2e4a; color: #fff; padding: 1.5rem; display: flex; justify-content: space-between; align-items: center; }
.service-detail-header h3 { color: #fff; font-size: 1.2rem; }
.service-detail-price { color: #f97316; font-weight: 700; font-size: .95rem; }
.service-detail-body  { padding: 1.25rem; }
.service-detail-row   { display: flex; justify-content: space-between; padding: .6rem .5rem; border-bottom: 1px solid #f3f4f6; font-size: .875rem; }
.service-detail-row:last-child { border: none; }
.service-detail-free strong { color: #16a34a; }
@media(max-width:768px){ .services-detail-grid { grid-template-columns: 1fr; } }
</style>
@endpush
