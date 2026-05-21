@extends('layouts.dashboard')
@section('title','Mes commandes')
@section('page-title','Mes commandes assignées')
@section('sidebar-role','Espace Expert')
@section('sidebar-links')
<a href="{{ route('expert.dashboard') }}" class="sidebar-link">🏠 Dashboard</a>
<a href="{{ route('expert.commandes') }}" class="sidebar-link active">📋 Mes commandes</a>
<a href="{{ route('expert.profil') }}" class="sidebar-link">👤 Mon profil</a>
@endsection
@section('content')
<div class="table-wrapper">
    <table class="data-table">
        <thead><tr><th>Référence</th><th>Client</th><th>Service</th><th>Sujet</th><th>Délai</th><th>Statut</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($commandes as $cmd)
            <tr>
                <td><strong>{{ $cmd->reference }}</strong></td>
                <td>{{ $cmd->client?->nom_complet }}</td>
                <td>{{ $cmd->service }}</td>
                <td>{{ Str::limit($cmd->sujet, 40) }}</td>
                <td>{{ $cmd->delai }}</td>
                <td><span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span></td>
                <td><a href="{{ route('expert.commandes.show', $cmd) }}" class="btn btn-outline-navy btn-xs">Gérer</a></td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Aucune commande assignée.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $commandes->links() }}
</div>
@endsection
