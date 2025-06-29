@extends('layouts.admin')

@section('title', 'Eventos Deportivos')

@section('content')
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h5 class="mb-0">Gestión de Eventos</h5>
        <form method="GET" action="{{ route('admin.events.index') }}" class="d-flex flex-wrap gap-2">
            <input type="text" name="search" class="form-control" placeholder="Buscar por equipo..." value="{{ request('search') }}" style="max-width: 200px;">
            <select name="status" class="form-select" style="max-width: 200px;" onchange="this.form.submit()">
                <option value="">Todos los estados</option>
                <option value="scheduled" @selected(request('status') == 'scheduled')>Programado</option>
                <option value="live" @selected(request('status') == 'live')>En Vivo</option>
                <option value="finished" @selected(request('status') == 'finished')>Finalizado</option>
                <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelado</option>
            </select>
            <button type="submit" class="btn btn-secondary">Filtrar</button>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nuevo Evento
            </a>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Liga</th>
                    <th>Fecha y Hora</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Cuotas (L/E/V)</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td><strong>#{{ $event->id }}</strong></td>
                    <td>
                        <div class="fw-bold">{{ $event->home_team }} vs {{ $event->away_team }}</div>
                        <small class="text-muted">{{ $event->game->name ?? 'N/A' }}</small>
                    </td>
                    <td>{{ $event->league }}</td>
                    <td>{{ $event->date->format('d M, Y H:i A') }}</td>
                    <td class="text-center">
                        @php
                            $statusConfig = [
                                'scheduled' => ['class' => 'bg-info bg-opacity-10 text-info', 'text' => 'Programado'],
                                'live' => ['class' => 'bg-danger bg-opacity-10 text-danger', 'text' => 'En Vivo'],
                                'finished' => ['class' => 'bg-secondary bg-opacity-10 text-secondary', 'text' => 'Finalizado'],
                                'cancelled' => ['class' => 'bg-dark bg-opacity-10 text-white', 'text' => 'Cancelado'],
                            ];
                            $config = $statusConfig[$event->status] ?? ['class' => 'bg-warning bg-opacity-10 text-warning', 'text' => ucfirst($event->status)];
                        @endphp
                        <span class="badge rounded-pill {{ $config['class'] }}">{{ $config['text'] }}</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <span class="badge bg-light text-dark">{{ number_format($event->home_odds, 2) }}</span>
                            <span class="badge bg-light text-dark">{{ number_format($event->draw_odds, 2) }}</span>
                            <span class="badge bg-light text-dark">{{ number_format($event->away_odds, 2) }}</span>
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $event->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $event->id }}" action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="fas fa-search-minus fa-2x text-muted-color mb-2"></i>
                        <p class="mb-0">No se encontraron eventos con los filtros aplicados.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($events->hasPages())
    <div class="card-footer">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(eventId) {
    if (confirm('¿Estás seguro de que deseas eliminar este evento? Esta acción no se puede deshacer.')) {
        document.getElementById('delete-form-' + eventId).submit();
    }
}
</script>
@endpush 