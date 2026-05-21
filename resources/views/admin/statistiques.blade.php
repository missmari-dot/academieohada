@extends('layouts.dashboard')
@section('title','Statistiques')
@section('page-title','Statistiques')
@section('sidebar-role','Administration')
@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
<a href="{{ route('admin.commandes') }}" class="sidebar-link">📋 Commandes</a>
<a href="{{ route('admin.candidatures') }}" class="sidebar-link">👤 Candidatures</a>
<a href="{{ route('admin.messages') }}" class="sidebar-link">✉️ Messages</a>
<a href="{{ route('admin.reclamations') }}" class="sidebar-link">⚠️ Réclamations</a>
<a href="{{ route('admin.clients') }}" class="sidebar-link">👥 Clients</a>
<a href="{{ route('admin.experts') }}" class="sidebar-link">🎓 Experts</a>
<a href="{{ route('admin.statistiques') }}" class="sidebar-link active">📈 Statistiques</a>
@endsection
@section('content')
<div class="stats-cards stats-cards-4">
    <div class="stat-card stat-card-green">
        <span class="stat-card-number">{{ number_format($stats['ca_total'], 0, ',', ' ') }}</span>
        <span class="stat-card-label">CA Total (FCFA)</span>
    </div>
    <div class="stat-card stat-card-orange">
        <span class="stat-card-number">{{ number_format($stats['ca_mois'], 0, ',', ' ') }}</span>
        <span class="stat-card-label">CA ce mois (FCFA)</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-number">{{ $stats['commandes_total'] }}</span>
        <span class="stat-card-label">Commandes totales</span>
    </div>
    <div class="stat-card">
        <span class="stat-card-number">{{ $stats['clients_total'] }}</span>
        <span class="stat-card-label">Clients inscrits</span>
    </div>
</div>

<div class="stats-grid-2">
    <div class="detail-card">
        <h3>📅 Commandes par mois ({{ date('Y') }})</h3>
        <table class="data-table">
            <thead><tr><th>Mois</th><th>Commandes</th><th>CA (FCFA)</th></tr></thead>
            <tbody>
                @php $moisFr = ['','Janv','Févr','Mars','Avr','Mai','Juin','Juil','Août','Sept','Oct','Nov','Déc']; @endphp
                @foreach($commandesParMois as $row)
                <tr>
                    <td>{{ $moisFr[$row->mois] ?? $row->mois }}</td>
                    <td>{{ $row->total }}</td>
                    <td>{{ number_format($row->ca, 0, ',', ' ') }} F</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="detail-card">
        <h3>📊 Commandes par statut</h3>
        @php $colors = ['nouveau'=>'blue','confirme'=>'indigo','en_redaction'=>'orange','revision'=>'yellow','livre'=>'green','cloture'=>'gray']; $labels = ['nouveau'=>'Nouveau','confirme'=>'Confirmé','en_redaction'=>'En rédaction','revision'=>'Révision','livre'=>'Livré','cloture'=>'Clôturé']; @endphp
        @foreach($commandesParStatut as $row)
        <div class="stat-bar-row">
            <span class="badge badge-{{ $colors[$row->statut] ?? 'gray' }}">{{ $labels[$row->statut] ?? $row->statut }}</span>
            <div class="stat-bar-outer">
                <div class="stat-bar-inner" style="width: {{ $stats['commandes_total'] > 0 ? round($row->total / $stats['commandes_total'] * 100) : 0 }}%"></div>
            </div>
            <span class="stat-bar-count">{{ $row->total }}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('styles')
<style>
.stats-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
.stat-bar-row { display: flex; align-items: center; gap: 1rem; padding: .75rem 0; border-bottom: 1px solid #f3f4f6; }
.stat-bar-outer { flex: 1; height: 8px; background: #e5e7eb; border-radius: 50px; overflow: hidden; }
.stat-bar-inner { height: 100%; background: #1a2e4a; border-radius: 50px; transition: width .3s; }
.stat-bar-count { font-weight: 700; color: #1a2e4a; min-width: 24px; text-align: right; }
@media(max-width:768px){ .stats-grid-2 { grid-template-columns: 1fr; } }
</style>
@endpush
