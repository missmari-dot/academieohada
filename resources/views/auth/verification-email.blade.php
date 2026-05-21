{{-- resources/views/auth/verification-email.blade.php --}}
@extends('layouts.app')
@section('title','Vérifiez votre email')
@section('content')
<section class="auth-section">
    <div class="auth-card text-center">
        <div class="auth-icon">✉️</div>
        <h2>Vérifiez votre email</h2>
        <p>Un lien de vérification a été envoyé à <strong>{{ auth()->user()->email }}</strong>.</p>
        <p>Cliquez sur le lien dans l'email pour activer votre compte.</p>
        @if(session('success'))<div class="alert alert-success mt-2">{{ session('success') }}</div>@endif
        <form method="POST" action="{{ route('verification.send') }}" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-outline-navy">Renvoyer l'email de vérification</button>
        </form>
        <form method="POST" action="{{ route('logout') }}" class="mt-1">
            @csrf
            <button type="submit" class="btn-text">Se déconnecter</button>
        </form>
    </div>
</section>
@endsection
