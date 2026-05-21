@extends('layouts.app')
@section('title', 'Demander un devis')

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Demander un devis gratuit</h1>
        <p>Remplissez le formulaire ci-dessous. Nous vous répondons en moins de 2h.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="devis-layout">

            {{-- ── Formulaire ── --}}
            <div class="devis-form-wrapper">
                <form action="{{ route('devis.store') }}" method="POST" enctype="multipart/form-data" id="devis-form">
                    @csrf

                    {{-- Étape 1 — Identité --}}
                    <div class="form-step">
                        <h3 class="step-title"><span class="step-num">1</span> Vos informations</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="prenom">Prénom *</label>
                                <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required class="form-input @error('prenom') is-error @enderror">
                                @error('prenom')<span class="form-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom *</label>
                                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required class="form-input @error('nom') is-error @enderror">
                                @error('nom')<span class="form-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="telephone">WhatsApp *</label>
                                <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" required placeholder="+221 77 XXX XX XX" class="form-input">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pays">Pays</label>
                                <select id="pays" name="pays" class="form-select">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($paysOhada as $p)
                                    <option value="{{ $p }}" {{ old('pays') === $p ? 'selected' : '' }}>{{ $p }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" id="ville" name="ville" value="{{ old('ville') }}" class="form-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="etablissement">Établissement</label>
                            <input type="text" id="etablissement" name="etablissement" value="{{ old('etablissement') }}" placeholder="UCAD, ISM, UGB..." class="form-input">
                        </div>
                    </div>

                    {{-- Étape 2 — Prestation --}}
                    <div class="form-step">
                        <h3 class="step-title"><span class="step-num">2</span> Votre prestation</h3>
                        <div class="form-group">
                            <label>Catégorie *</label>
                            <div class="radio-group">
                                @foreach(['Mémoire','Rédaction','Correction','Accompagnement','Visuel'] as $cat)
                                <label class="radio-card">
                                    <input type="radio" name="categorie" value="{{ $cat }}" {{ old('categorie', 'Mémoire') === $cat ? 'checked' : '' }} onchange="toggleMemoireFields()">
                                    <span>{{ $cat }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Champs spécifiques mémoire --}}
                        <div id="memoire-fields">
                            <div class="form-group">
                                <label>Niveau *</label>
                                <div class="radio-group">
                                    <label class="radio-card">
                                        <input type="radio" name="niveau" value="Master" {{ old('niveau','Master') === 'Master' ? 'checked' : '' }} onchange="updatePrices()">
                                        <span>🎓 Master</span>
                                    </label>
                                    <label class="radio-card">
                                        <input type="radio" name="niveau" value="Licence" {{ old('niveau') === 'Licence' ? 'checked' : '' }} onchange="updatePrices()">
                                        <span>📘 Licence</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Parties souhaitées</label>
                                <div class="checkbox-grid" id="parties-checkboxes">
                                    @php
                                    $partiesMaster  = ['choix_sujet'=>'Choix du sujet (5 000 — Offert si mémoire complet)','problematique'=>'Problématique (8 000)','plan'=>'Plan détaillé (5 000 — Offert si mémoire complet)','methodologie'=>'Méthodologie (10 000)','introduction'=>'Introduction (25 000)','partie1'=>'1ère Partie (50 000)','partie2'=>'2ème Partie (50 000)','conclusion'=>'Conclusion (5 000)','complet'=>'Mémoire complet (100 000 — ⭐)'];
                                    $partiesLicence = ['choix_sujet'=>'Choix du sujet (3 000 — Offert si mémoire complet)','problematique'=>'Problématique (5 000)','plan'=>'Plan détaillé (3 000)','methodologie'=>'Méthodologie (7 000)','introduction'=>'Introduction (15 000)','partie1'=>'1ère Partie (30 000)','partie2'=>'2ème Partie (30 000)','conclusion'=>'Conclusion (7 000)','complet'=>'Mémoire complet (60 000 — ⭐)'];
                                    @endphp
                                    @foreach($partiesMaster as $key => $label)
                                    <label class="checkbox-card" data-partie="{{ $key }}" data-master="{{ explode('(', explode(' ', $label)[count(explode(' ',$label))-2] ?? '0')[0] ?? 0 }}" data-licence="{{ $partiesLicence[$key] ?? '' }}">
                                        <input type="checkbox" name="parties[]" value="{{ $key }}" {{ in_array($key, old('parties', [])) ? 'checked' : '' }} onchange="updatePrices()">
                                        <span class="partie-label">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filiere">Discipline / Filière</label>
                            <input type="text" id="filiere" name="filiere" value="{{ old('filiere') }}" placeholder="ex: Droit OHADA, Finance, Informatique..." class="form-input">
                        </div>
                    </div>

                    {{-- Étape 3 — Sujet --}}
                    <div class="form-step">
                        <h3 class="step-title"><span class="step-num">3</span> Détails du sujet</h3>
                        <div class="form-group">
                            <label for="sujet">Sujet / Thème *</label>
                            <input type="text" id="sujet" name="sujet" value="{{ old('sujet') }}" required placeholder="ex: L'impact du droit OHADA sur les PME sénégalaises" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="date_soutenance">Date de soutenance</label>
                            <input type="date" id="date_soutenance" name="date_soutenance" value="{{ old('date_soutenance') }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="instructions">Instructions libres</label>
                            <textarea id="instructions" name="instructions" rows="4" class="form-textarea" placeholder="Précisions sur votre sujet, contraintes, références bibliographiques...">{{ old('instructions') }}</textarea>
                        </div>
                    </div>

                    {{-- Étape 4 — Délai --}}
                    <div class="form-step">
                        <h3 class="step-title"><span class="step-num">4</span> Délai souhaité</h3>
                        <div class="delai-selector">
                            @foreach([['30j','+25%','Très urgent','urgent'],['Quatre(4) mois','Normal','Standard','normal'],['Plus de 4 mois','−10%','Confortable','confort']] as $d)
                            <label class="delai-option delai-{{ $d[3] }}">
                                <input type="radio" name="delai" value="{{ $d[0] }}" {{ old('delai','30j') === $d[0] ? 'checked' : '' }} onchange="updatePrices()">
                                <span class="delai-days">{{ $d[0] }}</span>
                                <span class="delai-mod">{{ $d[1] }}</span>
                                <span class="delai-desc">{{ $d[2] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Étape 5 — Options --}}
                    <div class="form-step">
                        <h3 class="step-title"><span class="step-num">5</span> Options complémentaires</h3>
                        <div class="checkbox-grid">
                            @foreach([['powerpoint','PowerPoint soutenance',5000],['correction','Correction & Relecture',15000],['cv_lettre','CV + Lettre de motivation',5000],['accompagnement','Séance d\'accompagnement 2h',5000]] as $opt)
                            <label class="checkbox-card">
                                <input type="checkbox" name="options[]" value="{{ $opt[0] }}" {{ in_array($opt[0], old('options', [])) ? 'checked' : '' }} onchange="updatePrices()">
                                <span>{{ $opt[1] }} <strong>(+{{ number_format($opt[2],0,',',' ') }} FCFA)</strong></span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Étape 6 — Fichier --}}
                    <div class="form-step">
                        <h3 class="step-title"><span class="step-num">6</span> Fichiers joints (optionnel)</h3>
                        <div class="form-group">
                            <label for="fichier">PDF / Word / PPT (max 10 Mo)</label>
                            <input type="file" id="fichier" name="fichier" class="form-input" accept=".pdf,.doc,.docx,.ppt,.pptx">
                        </div>
                    </div>

                        </div>
                    </div>

                    {{-- Étape 8 — Mode d'envoi --}}
                    <div class="form-step step-highlight">
                        <h3 class="step-title"><span class="step-num">8</span> Recevoir mon devis</h3>
                        <p class="mb-2">Comment souhaitez-vous recevoir votre proposition tarifaire ?</p>
                        <div class="envoi-selector">
                            <label class="envoi-option">
                                <input type="radio" name="envoi_type" value="email" checked onchange="updateSubmitButton()">
                                <div class="envoi-content">
                                    <span class="envoi-icon">📧</span>
                                    <span class="envoi-label">Par Email</span>
                                    <span class="envoi-desc">Réponse détaillée sous 2h</span>
                                </div>
                            </label>
                            <label class="envoi-option">
                                <input type="radio" name="envoi_type" value="whatsapp" onchange="updateSubmitButton()">
                                <div class="envoi-content">
                                    <span class="envoi-icon">📲</span>
                                    <span class="envoi-label">Sur WhatsApp</span>
                                    <span class="envoi-desc">Contact direct et rapide</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" class="btn btn-blue btn-lg btn-full">
                        📩 Recevoir mon devis par Email →
                    </button>
                    <p class="form-note" id="submit-note">Une copie de votre demande vous sera envoyée instantanément.</p>
                </form>
            </div>

            {{-- ── Sidebar Récapitulatif ── --}}
            <div class="devis-sidebar">
                <div class="recap-card">
                    <h3>📋 Récapitulatif</h3>
                    <div id="recap-prestations">
                        <p class="recap-empty">Sélectionnez des parties pour voir le récapitulatif.</p>
                    </div>
                    <div class="recap-total">
                        <span>Total estimé</span>
                        <strong id="recap-total">0 FCFA</strong>
                    </div>
                    <p class="recap-note">Devis définitif confirmé sous 2h par WhatsApp.</p>
                    <div class="recap-contact">
                        <p>📱 <a href="https://wa.me/221775646246">+221 77 564 62 46</a></p>
                        <p>✉️ <a href="mailto:academie.redactionohada@gmail.com">academie.redactionohada@gmail.com</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Tarifs JS pour le récapitulatif temps réel
const TARIFS = {
    Master:  { choix_sujet:5000, problematique:8000, plan:5000, methodologie:10000, introduction:25000, partie1:50000, partie2:50000, conclusion:10000, complet:100000 },
    Licence: { choix_sujet:3000, problematique:5000, plan:3000, methodologie:7000,  introduction:15000, partie1:30000, partie2:30000, conclusion:7000,  complet:60000  },
};
const OPTIONS = { powerpoint:5000, correction:15000, cv_lettre:5000, accompagnement:5000 };
const DELAIS  = { '30j':1.25, 'Quatre(4) mois':1.0, 'Plus de 4 mois':0.9 };

function updatePrices() {
    const niveau   = document.querySelector('input[name="niveau"]:checked')?.value || 'Master';
    const delai    = document.querySelector('input[name="delai"]:checked')?.value   || '14j';
    const parties  = [...document.querySelectorAll('input[name="parties[]"]:checked')].map(i => i.value);
    const options  = [...document.querySelectorAll('input[name="options[]"]:checked')].map(i => i.value);

    let base = 0;
    const tarifs = TARIFS[niveau] || TARIFS.Master;
    const isComplet = parties.includes('complet');
    
    parties.forEach(p => { 
        if (p === 'choix_sujet' && isComplet) return; // Offert si complet
        base += tarifs[p] || 0; 
    });
    options.forEach(o => { base += OPTIONS[o] || 0; });

    const coeff = DELAIS[delai] || 1;
    const total = Math.round(base * coeff);

    // Mise à jour récapitulatif
    const recapDiv = document.getElementById('recap-prestations');
    const totalEl  = document.getElementById('recap-total');

    if (parties.length === 0 && options.length === 0) {
        recapDiv.innerHTML = '<p class="recap-empty">Sélectionnez des parties pour voir le récapitulatif.</p>';
    } else {
        let html = '';
        const labels = { choix_sujet:'Choix du sujet', problematique:'Problématique', plan:'Plan', methodologie:'Méthodologie', introduction:'Introduction', partie1:'1ère Partie', partie2:'2ème Partie', conclusion:'Conclusion', complet:'Mémoire complet' };
        const optLabels = { powerpoint:'PowerPoint', correction:'Correction', cv_lettre:'CV + Lettre', accompagnement:'Accompagnement' };
        parties.forEach(p  => { html += `<div class="recap-row"><span>${labels[p]||p}</span><span>${(tarifs[p]||0).toLocaleString('fr-FR')} FCFA</span></div>`; });
        options.forEach(o  => { html += `<div class="recap-row"><span>${optLabels[o]||o}</span><span>+${(OPTIONS[o]||0).toLocaleString('fr-FR')} FCFA</span></div>`; });
        if (coeff !== 1) { html += `<div class="recap-row recap-delai"><span>Modificateur délai (${delai})</span><span>×${coeff}</span></div>`; }
        recapDiv.innerHTML = html;
    }

    totalEl.textContent = total.toLocaleString('fr-FR') + ' FCFA';
}

function toggleMemoireFields() {
    const cat = document.querySelector('input[name="categorie"]:checked')?.value;
    document.getElementById('memoire-fields').style.display = cat === 'Mémoire' ? 'block' : 'none';
}

function updateSubmitButton() {
    const type = document.querySelector('input[name="envoi_type"]:checked')?.value;
    const btn  = document.getElementById('submit-btn');
    const note = document.getElementById('submit-note');
    
    if (type === 'whatsapp') {
        btn.innerHTML = '📲 Envoyer sur WhatsApp →';
        btn.className = 'btn btn-orange btn-lg btn-full';
        note.textContent = 'Vous serez redirigé vers WhatsApp avec votre devis pré-rempli.';
    } else {
        btn.innerHTML = '📩 Recevoir mon devis par Email →';
        btn.className = 'btn btn-blue btn-lg btn-full';
        note.textContent = 'Une confirmation vous sera envoyée instantanément par email.';
    }
}

document.addEventListener('DOMContentLoaded', () => { 
    updatePrices(); 
    toggleMemoireFields();
    updateSubmitButton();
});
</script>
@endpush
