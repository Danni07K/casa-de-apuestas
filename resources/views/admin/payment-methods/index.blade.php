@extends('layouts.admin')

@section('title', 'Métodos de Pago')

@section('content')
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h5 class="mb-0">Gestión de Métodos de Pago</h5>
        <div class="d-flex flex-wrap gap-2">
            <input type="text" class="form-control" placeholder="Buscar..." id="searchInput" style="max-width: 250px;">
            <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Nuevo Método
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Límites (Min/Max)</th>
                    <th class="text-center">Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paymentMethods as $method)
                <tr class="payment-method-row" data-name="{{ strtolower($method->name) }}">
                    <td><strong>#{{ $method->id }}</strong></td>
                    <td>
                        <div class="fw-bold">{{ $method->name }}</div>
                        <small class="text-muted-color">{{ Str::limit($method->description, 60) }}</small>
                    </td>
                    <td class="text-center">{{ ucfirst($method->type) }}</td>
                    <td class="text-center">S/ {{ number_format($method->min_amount, 2) }} / S/ {{ number_format($method->max_amount, 2) }}</td>
                    <td class="text-center">
                        @if($method->status === 'active')
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill">Activo</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('admin.payment-methods.edit', $method) }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $method->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $method->id }}" action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="fas fa-credit-card fa-2x text-muted-color mb-2"></i>
                        <p class="mb-0">No hay métodos de pago registrados.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($paymentMethods->hasPages())
    <div class="card-footer">
        {{ $paymentMethods->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(methodId) {
    if (confirm('¿Estás seguro de que deseas eliminar este método de pago?')) {
        document.getElementById('delete-form-' + methodId).submit();
    }
}

document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    document.querySelectorAll('.payment-method-row').forEach(row => {
        const name = row.dataset.name;
        row.style.display = name.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endpush 