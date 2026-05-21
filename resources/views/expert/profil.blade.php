@extends('layouts.dashboard')
@section('title','Mon profil')
@section('page-title','Mon profil expert')
@section('sidebar-role','Espace Expert')
@section('sidebar-links')
<a href="{{ route('expert.dashboard') }}" class="sidebar-link">🏠 Dashboard</a>
<a href="{{ route('expert.commandes') }}" class="sidebar-link">📋 Mes commandes</a>
<a href="{{ route('expert.profil') }}" class="sidebar-link active">👤 Mon profil</a>
@endsection
@section('content')
<div class="form-card" style="max-width:600px">
    <div class="profil-header">
        <img src="{{ $user->avatar_url }}" alt="Avatar" class="avatar-lg">
        <div><h3>{{ $user->nom_complet }}</h3><p>{{ $user->email }}</p></div>
    </div>
    <form method="POST" action="{{ route('expert.profil.update') }}">
        @csrf @method('PUT')
        <div class="form-row">
            <div class="form-group"><label>Prénom *</label><input type="text" name="prenom" value="{{ old('prenom',$user->prenom) }}" required class="form-input"></div>
            <div class="form-group"><label>Nom *</label><input type="text" name="nom" value="{{ old('nom',$user->nom) }}" required class="form-input"></div>
        </div>
        <div class="form-group"><label>Téléphone</label><input type="tel" name="telephone" value="{{ old('telephone',$user->telephone) }}" class="form-input"></div>
        <div class="form-row">
            <div class="form-group"><label>Pays</label><input type="text" name="pays" value="{{ old('pays',$user->pays) }}" class="form-input"></div>
            <div class="form-group"><label>Ville</label><input type="text" name="ville" value="{{ old('ville',$user->ville) }}" class="form-input"></div>
        </div>
        <button type="submit" class="btn btn-orange">Enregistrer</button>
    </form>
</div>
@endsection
