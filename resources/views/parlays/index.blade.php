@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-light mb-0">
                    <i class="fas fa-layer-group me-2"></i>
                    Mis Parlays
                </h2>
                <a href="{{ route('parlays.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>
                    Nuevo Parlay
                </a>
            </div>

            @if($parlays->count() > 0)
                <div class="row">
                    @foreach($parlays as $parlay)
                        <div class="col-lg-6 col-xl-4 mb-4">
                            <div class="card h-100 parlay-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span class="badge bg-{{ $parlay->status === 'won' ? 'success' : ($parlay->status === 'lost' ? 'danger' : ($parlay->status === 'partial' ? 'warning' : 'secondary')) }}">
                                        {{ ucfirst($parlay->status) }}
                                    </span>
                                    <small class="text-muted">{{ $parlay->created_at->format('d/m/Y H:i') }}</small>
                                </div>

                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <small class="text-muted">Apuesta</small>
                                            <div class="fw-bold">PEN {{ number_format($parlay->amount, 2) }}</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Ganancia Potencial</small>
                                            <div class="fw-bold text-success">PEN {{ number_format($parlay->potential_win, 2) }}</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <small class="text-muted">Cuotas Totales</small>
                                            <div class="fw-bold">{{ number_format($parlay->total_odds, 2) }}</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Selecciones</small>
                                            <div class="fw-bold">{{ $parlay->total_selections }}</div>
                                        </div>
                                    </div>

                                    @if($parlay->status === 'partial')
                                        <div class="alert alert-warning py-2 mb-3">
                                            <small>
                                                <i class="fas fa-info-circle me-1"></i>
                                                Ganancia parcial: PEN {{ number_format($parlay->partial_win_amount, 2) }}
                                            </small>
                                        </div>
                                    @endif

                                    <div class="selections-preview">
                                        @foreach($parlay->selections->take(3) as $selection)
                                            <div class="selection-item mb-2">
                                                <small class="text-muted">{{ $selection->event->home_team }} vs {{ $selection->event->away_team }}</small>
                                                <div class="d-flex justify-content-between">
                                                    <span class="small">{{ ucfirst($selection->bet_type) }}: {{ $selection->selection }}</span>
                                                    <span class="badge bg-{{ $selection->status === 'won' ? 'success' : ($selection->status === 'lost' ? 'danger' : 'secondary') }} small">
                                                        {{ $selection->status === 'won' ? '✓' : ($selection->status === 'lost' ? '✗' : '...') }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($parlay->selections->count() > 3)
                                            <div class="text-center">
                                                <small class="text-muted">+{{ $parlay->selections->count() - 3 }} más</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('parlays.show', $parlay) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>
                                            Ver Detalles
                                        </a>

                                        @if($parlay->status === 'pending')
                                            <form method="POST" action="{{ route('parlays.cancel', $parlay) }}" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('¿Estás seguro de cancelar este parlay?')">
                                                    <i class="fas fa-times me-1"></i>
                                                    Cancelar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{ $parlays->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-layer-group fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No tienes parlays aún</h4>
                    <p class="text-muted">¡Crea tu primer parlay y multiplica tus ganancias!</p>
                    <a href="{{ route('parlays.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>
                        Crear Primer Parlay
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.parlay-card {
    background: linear-gradient(135deg, #1a1f35 0%, #2a2f45 100%);
    border: 1px solid rgba(47, 211, 93, 0.2);
    transition: all 0.3s ease;
}

.parlay-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(47, 211, 93, 0.15);
    border-color: rgba(47, 211, 93, 0.4);
}

.selection-item {
    padding: 8px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 6px;
    border-left: 3px solid rgba(47, 211, 93, 0.5);
}

.card-header {
    background: rgba(47, 211, 93, 0.1);
    border-bottom: 1px solid rgba(47, 211, 93, 0.2);
}

.card-footer {
    background: rgba(0, 0, 0, 0.2);
    border-top: 1px solid rgba(47, 211, 93, 0.2);
}
</style>
@endsection
