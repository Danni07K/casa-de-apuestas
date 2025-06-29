@extends('layouts.admin')

@section('title', 'Tipos de Apuestas')

@section('content')
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h5 class="mb-0">Gestión de Tipos de Apuestas</h5>
        <div class="d-flex flex-wrap gap-2">
            <input type="text" class="form-control" placeholder="Buscar..." id="searchInput" style="max-width: 250px;">
            <a href="{{ route('admin.bet-types.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nuevo Tipo
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre y Descripción</th>
                    <th class="text-center">Selecciones (Min/Max)</th>
                    <th class="text-center">Apuesta (Min/Max)</th>
                    <th class="text-center">Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($betTypes as $betType)
                <tr class="bet-type-row" data-name="{{ strtolower($betType->name) }}">
                    <td><strong>#{{ $betType->id }}</strong></td>
                    <td>
                        <div class="fw-bold">{{ $betType->name }}</div>
                        <small class="text-muted-color">{{ Str::limit($betType->description, 60) }}</small>
                    </td>
                    <td class="text-center">{{ $betType->min_selections }} / {{ $betType->max_selections }}</td>
                    <td class="text-center">S/ {{ number_format($betType->min_stake, 2) }} / S/ {{ number_format($betType->max_stake, 2) }}</td>
                    <td class="text-center">
                        @if($betType->status)
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Activo</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('admin.bet-types.edit', $betType) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $betType->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $betType->id }}" action="{{ route('admin.bet-types.destroy', $betType) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="fas fa-dice fa-2x text-muted-color mb-2"></i>
                        <p class="mb-0">No hay tipos de apuestas registrados.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($betTypes->hasPages())
    <div class="card-footer">
        {{ $betTypes->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(betTypeId) {
    if (confirm('¿Estás seguro de que deseas eliminar este tipo de apuesta?')) {
        document.getElementById('delete-form-' + betTypeId).submit();
    }
}

document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('.bet-type-row').forEach(row => {
        const name = row.dataset.name;
        row.style.display = name.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endpush 