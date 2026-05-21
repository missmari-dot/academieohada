{{-- resources/views/auth/mot-de-passe-oublie.blade.php --}}
@extends('layouts.app')
@section('title', 'Mot de passe oublié')
@section('content')
<section class="auth-section">
    <div class="auth-card">
        <div class="auth-brand"><h2>Mot de passe oublié</h2><p>Entrez votre email pour recevoir un lien de réinitialisation.</p></div>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert alert-error">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>@endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="form-input">
            </div>
            <button type="submit" class="btn btn-orange btn-full">Envoyer le lien de réinitialisation</button>
        </form>
        <p class="auth-links"><a href="{{ route('login') }}">← Retour à la connexion</a></p>
    </div>
</section>
@endsection
