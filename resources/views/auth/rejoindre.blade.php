@extends('layouts.app')
@section('title', 'Rejoindre l\'équipe')

@section('content')
<section class="page-hero">
    <div class="container">
        <h1>Rejoindre l'équipe AcadémieOHADA</h1>
        <p>Vous êtes expert académique ? Soumettez votre candidature ci-dessous.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="auth-card auth-card-wide">
            @if($errors->any())
                <div class="alert alert-error">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>
            @endif
            <form method="POST" action="{{ route('rejoindre.store') }}" enctype="multipart/form-data">
                @csrf
                <h3 class="step-title"><span class="step-num">1</span> Informations personnelles</h3>
                <div class="form-row">
                    <div class="form-group"><label>Prénom *</label><input type="text" name="prenom" value="{{ old('prenom') }}" required class="form-input"></div>
                    <div class="form-group"><label>Nom *</label><input type="text" name="nom" value="{{ old('nom') }}" required class="form-input"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>Email *</label><input type="email" name="email" value="{{ old('email') }}" required class="form-input"></div>
                    <div class="form-group"><label>WhatsApp *</label><input type="tel" name="telephone" value="{{ old('telephone') }}" required class="form-input"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>Pays *</label><input type="text" name="pays" value="{{ old('pays','Sénégal') }}" required class="form-input"></div>
                    <div class="form-group"><label>Ville *</label><input type="text" name="ville" value="{{ old('ville') }}" required class="form-input"></div>
                </div>

                <h3 class="step-title mt-3"><span class="step-num">2</span> Profil académique</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label>Diplôme le plus élevé *</label>
                        <select name="diplome" required class="form-select">
                            @foreach(['Licence','Master','Doctorat'] as $d)
                            <option value="{{ $d }}" {{ old('diplome') === $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Années d'expérience *</label>
                        <select name="annees_experience" required class="form-select">
                            @foreach(['0-1','1-3','3-5','5+'] as $a)
                            <option value="{{ $a }}" {{ old('annees_experience') === $a ? 'selected' : '' }}>{{ $a }} ans</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group"><label>Spécialité / Filière *</label><input type="text" name="specialite" value="{{ old('specialite') }}" required placeholder="ex: Droit OHADA, Finance, Informatique" class="form-input"></div>
                <div class="form-group"><label>Établissement d'obtention du diplôme *</label><input type="text" name="etablissement_diplome" value="{{ old('etablissement_diplome') }}" required class="form-input"></div>

                <h3 class="step-title mt-3"><span class="step-num">3</span> Services proposés</h3>
                <div class="checkbox-grid">
                    @foreach(['Rédaction de mémoires','Correction & Relecture','Dissertation & Exposés','CV + Lettre de motivation','Formation méthodologie','Suivi & Accompagnement','PowerPoint soutenance','Flyers / Visuels'] as $s)
                    <label class="checkbox-card">
                        <input type="checkbox" name="services_proposes[]" value="{{ $s }}" {{ in_array($s, old('services_proposes',[])) ? 'checked' : '' }}>
                        <span>{{ $s }}</span>
                    </label>
                    @endforeach
                </div>

                <div class="form-group mt-2">
                    <label>Disponibilité *</label>
                    <select name="disponibilite" required class="form-select">
                        @foreach(['Temps plein','Temps partiel','Week-end'] as $d)
                        <option value="{{ $d }}" {{ old('disponibilite') === $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>

                <h3 class="step-title mt-3"><span class="step-num">4</span> Documents</h3>
                <div class="form-group"><label>CV * (PDF, max 5 Mo)</label><input type="file" name="cv" required accept=".pdf" class="form-input"></div>
                <div class="form-group"><label>Lettre de motivation (optionnel)</label><input type="file" name="lettre" accept=".pdf" class="form-input"></div>
                <div class="form-group"><label>Extrait de travaux (optionnel)</label><input type="file" name="travaux" accept=".pdf,.doc,.docx" class="form-input"></div>

                <h3 class="step-title mt-3"><span class="step-num">5</span> Sécurité du compte</h3>
                <div class="form-row">
                    <div class="form-group"><label>Mot de passe souhaité *</label><input type="password" name="password" required class="form-input"><span class="form-hint">Min. 8 car., 1 majuscule, 1 chiffre, 1 spécial</span></div>
                    <div class="form-group"><label>Confirmer *</label><input type="password" name="password_confirmation" required class="form-input"></div>
                </div>

                <div class="form-group"><label>Pourquoi rejoindre AcadémieOHADA ?</label><textarea name="message_libre" rows="4" class="form-textarea" placeholder="Décrivez votre motivation...">{{ old('message_libre') }}</textarea></div>

                <button type="submit" class="btn btn-orange btn-full btn-lg">Soumettre ma candidature →</button>
                <p class="form-note">Votre candidature sera examinée dans les 48h. Vous recevrez un email de réponse.</p>
            </form>
        </div>
    </div>
</section>
@endsection
