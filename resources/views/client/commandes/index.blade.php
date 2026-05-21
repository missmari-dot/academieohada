{{-- resources/views/client/commandes/index.blade.php --}}
@extends('layouts.dashboard')
@section('title','Mes commandes')
@section('page-title','Mes commandes')
@section('sidebar-role','Espace Client')
@section('sidebar-links')
<a href="{{ route('client.dashboard') }}" class="sidebar-link">🏠 Tableau de bord</a>
<a href="{{ route('client.commandes') }}" class="sidebar-link active">📋 Mes commandes</a>
<a href="{{ route('client.profil') }}" class="sidebar-link">👤 Mon profil</a>
<a href="{{ route('devis') }}" class="sidebar-link sidebar-cta">⚡ Nouvelle commande</a>
@endsection
@section('content')
<div class="table-wrapper">
    <table class="data-table">
        <thead>
            <tr><th>Référence</th><th>Service</th><th>Sujet</th><th>Montant</th><th>Statut</th><th>Date</th><th>Action</th></tr>
        </thead>
        <tbody>
            @forelse($commandes as $cmd)
            <tr>
                <td><strong>{{ $cmd->reference }}</strong></td>
                <td>{{ $cmd->service }} {{ $cmd->niveau ? "({$cmd->niveau})" : '' }}</td>
                <td>{{ Str::limit($cmd->sujet, 50) }}</td>
                <td>{{ number_format($cmd->montant, 0, ',', ' ') }} FCFA</td>
                <td><span class="badge badge-{{ $cmd->statut_color }}">{{ $cmd->statut_label }}</span></td>
                <td>{{ $cmd->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ route('client.commandes.show', $cmd) }}" class="btn btn-outline-navy btn-xs">Détail</a></td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Aucune commande pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $commandes->links() }}
</div>
@endsection
