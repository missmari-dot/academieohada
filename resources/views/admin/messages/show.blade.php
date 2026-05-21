@extends('layouts.dashboard')
@section('title', $message->sujet)
@section('page-title', 'Message — ' . $message->sujet)
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link active">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link">📈 Statistiques</a>
@endsection
@section('content')
<div class="detail-layout">
    <div class="detail-main">
        <div class="detail-card">
            <h3>✉️ Message</h3>
            <div class="detail-grid">
                <div class="detail-row"><span>De</span><strong>{{ $message->prenom }} {{ $message->nom }}</strong></div>
                <div class="detail-row"><span>Email</span><span>{{ $message->email }}</span></div>
                @if($message->telephone)<div class="detail-row"><span>Téléphone</span><span>{{ $message->telephone }}</span></div>@endif
                <div class="detail-row"><span>Sujet</span><span>{{ $message->sujet }}</span></div>
                <div class="detail-row"><span>Date</span><span>{{ $message->created_at->format('d/m/Y à H:i') }}</span></div>
            </div>
            <div class="message-body">{{ $message->contenu }}</div>
        </div>
    </div>
    <div class="detail-sidebar">
        <div class="detail-card">
            <h4>Répondre</h4>
            @if($message->telephone)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$message->telephone) }}?text={{ rawurlencode('Bonjour '.$message->prenom.', suite à votre message concernant : '.$message->sujet.' —') }}" target="_blank" class="btn btn-outline-navy btn-full btn-sm mb-1">💬 WhatsApp</a>
            @endif
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->sujet }}" class="btn btn-outline-navy btn-full btn-sm">✉️ Email</a>
        </div>
        <a href="{{ route('admin.messages') }}" class="btn btn-outline-navy btn-full btn-sm">← Retour</a>
    </div>
</div>
@endsection
@push('styles')
<style>
.message-body { background: #f9fafb; border-radius: 8px; padding: 1.25rem; margin-top: 1.25rem; font-size: .9rem; line-height: 1.7; white-space: pre-wrap; color: #374151; }
.row-unread { background: #fffbeb; }
</style>
@endpush
