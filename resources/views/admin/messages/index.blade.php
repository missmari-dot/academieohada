@extends('layouts.dashboard')
@section('title','Messages')
@section('page-title','Messages de contact')
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
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Expéditeur</th><th>Sujet</th><th>Email</th><th>Lu</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($messages as $msg)
            <tr class="{{ !$msg->lu ? 'row-unread' : '' }}">
                <td><strong>{{ $msg->prenom }} {{ $msg->nom }}</strong></td>
                <td>{{ Str::limit($msg->sujet, 50) }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->lu ? '✅' : '🔴 Nouveau' }}</td>
                <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                <td><a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-outline-navy btn-xs">Lire</a></td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Aucun message.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $messages->links() }}
</div>
@endsection
