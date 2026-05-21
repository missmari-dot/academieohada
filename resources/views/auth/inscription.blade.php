@extends('layouts.app')
@section('title', 'Créer un compte')

@section('content')
<section class="auth-section">
    <div class="auth-card auth-card-wide">
        <div class="auth-brand">
            <h2>Créer votre compte</h2>
            <p>Accédez à votre espace étudiant AcadémieOHADA</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required class="form-input @error('prenom') is-error @enderror">
                </div>
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required class="form-input @error('nom') is-error @enderror">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-input @error('email') is-error @enderror">
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone / WhatsApp *</label>
                <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" required placeholder="+221 77 XXX XX XX" class="form-input">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="pays">Pays *</label>
                    <select id="pays" name="pays" required class="form-select">
                        <option value="">-- Sélectionner --</option>
                        @foreach(['Sénégal','Bénin','Burkina Faso','Cameroun','Centrafrique','Comores','Congo','Côte d\'Ivoire','Gabon','Guinée','Guinée-Bissau','Guinée équatoriale','Mali','Niger','RDC','Tchad','Togo','Cap-Vert','Gambie','Ghana','Libéria','Nigeria','Sierra Leone','Autre'] as $p)
                        <option value="{{ $p }}" {{ old('pays') === $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville') }}" class="form-input">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="etablissement">Établissement</label>
                    <select id="etablissement" name="etablissement" class="form-select">
                        <option value="">-- Sélectionner --</option>
                        @foreach(['UCAD','ISM','UGB','ESP','SUPDECO','ISEG','Autre'] as $e)
                        <option value="{{ $e }}" {{ old('etablissement') === $e ? 'selected' : '' }}>{{ $e }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="niveau_etudes">Niveau d'études</label>
                    <select id="niveau_etudes" name="niveau_etudes" class="form-select">
                        <option value="">-- Sélectionner --</option>
                        @foreach(['Licence','Master','Doctorat','Professionnel'] as $n)
                        <option value="{{ $n }}" {{ old('niveau_etudes') === $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Mot de passe *</label>
                    <input type="password" id="password" name="password" required class="form-input @error('password') is-error @enderror">
                    <span class="form-hint">Min. 8 car., 1 majuscule, 1 chiffre, 1 spécial</span>
                    @error('password')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmer *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="form-input">
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" id="cgu" name="cgu" value="1" required {{ old('cgu') ? 'checked' : '' }}>
                <label for="cgu">J'accepte les <a href="#" class="form-link">conditions générales d'utilisation</a> *</label>
            </div>
            @error('cgu')<span class="form-error">{{ $message }}</span>@enderror

            <button type="submit" class="btn btn-orange btn-full btn-lg mt-2">Créer mon compte</button>
        </form>

        <div class="auth-divider"><span>ou</span></div>
        <a href="{{ route('auth.google') }}" class="btn btn-google btn-full">
            <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
            Continuer avec Google
        </a>
        <p class="auth-links">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
    </div>
</section>
@endsection
