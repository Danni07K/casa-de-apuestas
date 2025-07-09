@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="fas fa-layer-group text-success me-2"></i>
                    <h3 class="mb-0">Detalle del Parlay #{{ $parlay->id }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <div class="fw-bold text-success">Monto Apostado</div>
                            <div class="display-6">PEN {{ number_format($parlay->amount,2) }}</div>
                        </div>
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <div class="fw-bold text-info">Cuota Total</div>
                            <div class="display-6">{{ number_format($parlay->total_odds,2) }}</div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="fw-bold text-warning">Ganancia Potencial</div>
                            <div class="display-6">PEN {{ number_format($parlay->potential_win,2) }}</div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="badge bg-{{ $parlay->status === 'won' ? 'success' : ($parlay->status === 'lost' ? 'danger' : ($parlay->status === 'partial' ? 'warning' : 'secondary')) }}">
                            {{ ucfirst($parlay->status) }}
                        </span>
                        <small class="text-muted ms-2">Creado: {{ $parlay->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <h5 class="mb-3">Selecciones</h5>
                    <ol class="list-group list-group-numbered mb-4">
                        @foreach($parlay->selections as $sel)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">{{ $sel->event_name ?? ($sel->event->home_team ?? '') . ' vs ' . ($sel->event->away_team ?? '') }}</div>
                                <div class="text-muted small">{{ $sel->league ?? ($sel->event->league ?? '') }}</div>
                                <div class="text-muted small">Tipo: {{ $sel->bet_type }} | Selección: {{ $sel->selection }}</div>
                            </div>
                            <span class="badge bg-{{ $sel->status === 'won' ? 'success' : ($sel->status === 'lost' ? 'danger' : 'secondary') }}">
                                {{ number_format($sel->odds,2) }} cuota
                            </span>
                        </li>
                        @endforeach
                    </ol>
                    <div class="text-center mt-4">
                        <a href="{{ route('parlays.index') }}" class="btn btn-outline-success me-2">Volver a Parlays</a>
                        <a href="{{ route('betting.index') }}" class="btn btn-primary">Ir a Apuestas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
