{{-- resources/views/auth/reinitialiser-mot-de-passe.blade.php --}}
@extends('layouts.app')
@section('title','Réinitialiser le mot de passe')
@section('content')
<section class="auth-section">
    <div class="auth-card">
        <div class="auth-brand"><h2>Nouveau mot de passe</h2></div>
        @if($errors->any())<div class="alert alert-error">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>@endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ $email ?? old('email') }}" required class="form-input"></div>
            <div class="form-group"><label>Nouveau mot de passe</label><input type="password" name="password" required class="form-input"><span class="form-hint">Min. 8 car., 1 majuscule, 1 chiffre, 1 spécial</span></div>
            <div class="form-group"><label>Confirmer</label><input type="password" name="password_confirmation" required class="form-input"></div>
            <button type="submit" class="btn btn-orange btn-full">Réinitialiser</button>
        </form>
    </div>
</section>
@endsection
