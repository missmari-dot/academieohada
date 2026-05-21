@extends('layouts.dashboard')
@section('title','Mon profil')
@section('page-title','Mon profil')
@section('sidebar-role','Espace Client')
@section('sidebar-links')
<a href="{{ route('client.dashboard') }}" class="sidebar-link">🏠 Tableau de bord</a>
<a href="{{ route('client.commandes') }}" class="sidebar-link">📋 Mes commandes</a>
<a href="{{ route('client.profil') }}" class="sidebar-link active">👤 Mon profil</a>
<a href="{{ route('devis') }}" class="sidebar-link sidebar-cta">⚡ Nouvelle commande</a>
@endsection
@section('content')
<div class="form-card">
    <div class="profil-header">
        <img src="{{ $user->avatar_url }}" alt="Avatar" class="avatar-lg">
        <div><h3>{{ $user->nom_complet }}</h3><p>{{ $user->email }}</p></div>
    </div>
    <form method="POST" action="{{ route('client.profil.update') }}">
        @csrf @method('PUT')
        <div class="form-row">
            <div class="form-group"><label>Prénom *</label><input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" required class="form-input"></div>
            <div class="form-group"><label>Nom *</label><input type="text" name="nom" value="{{ old('nom', $user->nom) }}" required class="form-input"></div>
        </div>
        <div class="form-group"><label>Téléphone / WhatsApp</label><input type="tel" name="telephone" value="{{ old('telephone', $user->telephone) }}" class="form-input"></div>
        <div class="form-row">
            <div class="form-group"><label>Pays</label><input type="text" name="pays" value="{{ old('pays', $user->pays) }}" class="form-input"></div>
            <div class="form-group"><label>Ville</label><input type="text" name="ville" value="{{ old('ville', $user->ville) }}" class="form-input"></div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Établissement</label><input type="text" name="etablissement" value="{{ old('etablissement', $user->etablissement) }}" class="form-input"></div>
            <div class="form-group"><label>Niveau d'études</label><input type="text" name="niveau_etudes" value="{{ old('niveau_etudes', $user->niveau_etudes) }}" class="form-input"></div>
        </div>
        <button type="submit" class="btn btn-orange">Enregistrer les modifications</button>
    </form>
</div>
@endsection
