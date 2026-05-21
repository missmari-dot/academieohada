{{-- resources/views/pages/reclamations.blade.php --}}
@extends('layouts.app')
@section('title','Réclamations & Suggestions')
@section('content')
<section class="page-hero"><div class="container"><h1>Réclamations & Suggestions</h1><p>Votre satisfaction est notre priorité. Signalez tout problème ou partagez vos idées.</p></div></section>
<section class="section">
    <div class="container" style="max-width:680px">
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert alert-error">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>@endif
        <div class="form-card">
            <form method="POST" action="{{ route('reclamations.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group"><label>Prénom *</label><input type="text" name="prenom" value="{{ old('prenom', auth()->user()?->prenom) }}" required class="form-input"></div>
                    <div class="form-group"><label>Nom *</label><input type="text" name="nom" value="{{ old('nom', auth()->user()?->nom) }}" required class="form-input"></div>
                </div>
                <div class="form-group"><label>Email *</label><input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}" required class="form-input"></div>
                <div class="form-group">
                    <label>Type *</label>
                    <div class="radio-group">
                        <label class="radio-card"><input type="radio" name="type" value="reclamation" {{ old('type','reclamation') === 'reclamation' ? 'checked':'' }}><span>⚠️ Réclamation</span></label>
                        <label class="radio-card"><input type="radio" name="type" value="suggestion" {{ old('type') === 'suggestion' ? 'checked':'' }}><span>💡 Suggestion</span></label>
                    </div>
                </div>
                <div class="form-group"><label>Message *</label><textarea name="message" rows="6" required class="form-textarea" placeholder="Décrivez votre réclamation ou suggestion en détail...">{{ old('message') }}</textarea></div>
                <button type="submit" class="btn btn-orange btn-lg btn-full">Envoyer</button>
            </form>
        </div>
    </div>
</section>
@endsection
