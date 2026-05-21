@extends('layouts.app')
@section('title','Notre équipe')
@section('content')
<section class="page-hero"><div class="container"><h1>Notre équipe d'experts</h1><p>Des professionnels locaux, diplômés et passionnés au service de votre réussite académique.</p></div></section>
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">100% experts locaux sénégalais</span>
            <h2 class="section-title">Qui sommes-nous ?</h2>
            <p class="section-subtitle">Notre équipe est composée d'experts diplômés de Master et Doctorat, spécialisés dans leurs domaines respectifs.</p>
        </div>
        <div class="team-grid">
            @foreach([
                ['D','Diabel','Fondateur & Directeur','Compabilité · Doctorant en Finance d entreprise'],
                ['A','Aminata S.','Experte en Finance','Finance · Économie · Commerce international'],
                ['M','Moussa K.','Expert Juridique','Droit public · Droit privé · Fiscalité'],
                ['F','Fatou B.','Experte en Lettres','Littérature · Linguistique · Sciences de l\'éducation'],
                ['I','Ibrahima D.','Expert en Informatique','Informatique · SI · Technologies'],
                ['S','Sokhna N.','Experte en Sciences Sociales','Sociologie · Sciences politiques · RH'],
            ] as $m)
            <div class="team-card">
                <div class="team-avatar">{{ $m[0] }}</div>
                <h3>{{ $m[1] }}</h3>
                <p class="team-role">{{ $m[2] }}</p>
                <p class="team-specialite">{{ $m[3] }}</p>
            </div>
            @endforeach
        </div>
        <div class="team-cta">
            <p>Vous êtes expert académique et souhaitez rejoindre notre équipe ?</p>
            <a href="{{ route('rejoindre') }}" class="btn btn-orange">Postuler →</a>
        </div>
    </div>
</section>
@endsection
@push('styles')
<style>
.team-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; margin-bottom: 3rem; }
.team-card { border: 1px solid #e5e7eb; border-radius: 16px; padding: 2rem; text-align: center; transition: all .2s; }
.team-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.1); transform: translateY(-2px); }
.team-avatar { width: 72px; height: 72px; border-radius: 50%; background: #1a2e4a; color: #fff; display: flex; align-items: center; justify-content: center; font-family:'Cormorant Garamond',serif; font-size: 1.75rem; font-weight: 700; margin: 0 auto 1rem; }
.team-card h3 { font-size: 1.1rem; margin-bottom: .25rem; }
.team-role    { color: #f97316; font-size: .875rem; font-weight: 600; margin-bottom: .4rem; }
.team-specialite { font-size: .8rem; color: #9ca3af; }
.team-cta { text-align: center; padding: 2rem; background: #f9fafb; border-radius: 16px; }
.team-cta p { margin-bottom: 1rem; font-size: 1.05rem; color: #374151; }
@media(max-width:768px){ .team-grid { grid-template-columns: 1fr 1fr; } }
</style>
@endpush
