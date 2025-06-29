@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    {{-- Estas tarjetas de estadísticas necesitarán que les pases las variables desde el controlador --}}
    {{-- Ejemplo: $activeEventsCount, $betTypesCount, etc. --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-muted small text-uppercase">Eventos Activos</div>
                    <div class="h3 fw-bold mb-0 text-white">{{ App\Models\Event::where('status', 'scheduled')->count() }}</div>
                </div>
                <div class="ms-3 text-primary" style="font-size: 2.5rem;">
                    <i class="fas fa-futbol"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-muted small text-uppercase">Tipos de Apuestas</div>
                    <div class="h3 fw-bold mb-0 text-white">{{ App\Models\BetType::count() }}</div>
                </div>
                <div class="ms-3 text-primary" style="font-size: 2.5rem;">
                    <i class="fas fa-list"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-muted small text-uppercase">Métodos de Pago</div>
                    <div class="h3 fw-bold mb-0 text-white">{{ App\Models\PaymentMethod::where('status', 'active')->count() }}</div>
                </div>
                <div class="ms-3 text-primary" style="font-size: 2.5rem;">
                    <i class="fas fa-credit-card"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-muted small text-uppercase">Anuncios Activos</div>
                    <div class="h3 fw-bold mb-0 text-white">{{ App\Models\Announcement::where('is_active', true)->count() }}</div>
                </div>
                <div class="ms-3 text-primary" style="font-size: 2.5rem;">
                    <i class="fas fa-bullhorn"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Próximos Eventos</span>
                <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-secondary">Ver Todos</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Idealmente, $upcomingEvents debería venir del controlador --}}
                        @forelse(App\Models\Event::where('status', 'scheduled')->orderBy('date')->take(5)->get() as $event)
                        <tr>
                            <td>
                                <strong>{{ $event->home_team }}</strong> vs <strong>{{ $event->away_team }}</strong>
                                <div class="small text-muted">{{ $event->game->name ?? 'Deporte' }}</div>
                            </td>
                            <td>{{ $event->date->format('d M, Y H:i') }}</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill">{{ ucfirst($event->status) }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No hay eventos próximos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5 mb-4">
        <div class="card">
            <div class="card-header">
                Accesos Rápidos
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.events.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-plus-circle me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">Nuevo Evento</div>
                            <small class="text-muted">Crear un nuevo partido o competición.</small>
                        </div>
                    </a>
                    <a href="{{ route('admin.bet-types.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-dice me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">Nuevo Tipo de Apuesta</div>
                            <small class="text-muted">Añadir una nueva modalidad de apuesta.</small>
                        </div>
                    </a>
                    <a href="{{ route('admin.payment-methods.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-money-bill-wave me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">Nuevo Método de Pago</div>
                            <small class="text-muted">Configurar una nueva forma de pago.</small>
                        </div>
                    </a>
                    <a href="{{ route('admin.announcements.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-bullhorn me-3 text-primary"></i>
                        <div>
                            <div class="fw-bold">Nuevo Anuncio</div>
                            <small class="text-muted">Publicar una notificación para los usuarios.</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.text-primary {
    color: var(--primary-color) !important;
}
.list-group-item {
    background-color: transparent;
    border-color: var(--border-color);
    color: var(--text-color);
}
.list-group-item-action:hover, .list-group-item-action:focus {
    background-color: rgba(47, 211, 93, 0.08);
    color: var(--text-color);
}
</style>
@endpush 