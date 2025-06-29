@extends('layouts.admin')

@section('title', 'Depósitos')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Gestión de Depósitos</h5>
        {{-- El botón para crear podría ir aquí si tienes una vista para ello --}}
        {{-- <a href="{{ route('admin.deposits.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Nuevo Depósito Manual
        </a> --}}
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Método</th>
                        <th class="text-end">Monto</th>
                        <th>Referencia</th>
                        <th>Fecha</th>
                        <th class="text-center">Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deposits as $deposit)
                        <tr>
                            <td><strong>#{{ $deposit->id }}</strong></td>
                            <td>{{ $deposit->user->name }}</td>
                            <td>{{ $deposit->paymentMethod->name }}</td>
                            <td class="text-end fw-bold">S/ {{ number_format($deposit->amount, 2) }}</td>
                            <td>{{ $deposit->reference_number }}</td>
                            <td>{{ $deposit->created_at->format('d M, Y H:i A') }}</td>
                            <td class="text-center">
                                @php
                                    $statusClass = '';
                                    $statusText = '';
                                    switch ($deposit->status) {
                                        case 'pending':
                                            $statusClass = 'bg-warning bg-opacity-10 text-warning';
                                            $statusText = 'Pendiente';
                                            break;
                                        case 'approved':
                                            $statusClass = 'bg-success bg-opacity-10 text-success';
                                            $statusText = 'Aprobado';
                                            break;
                                        case 'rejected':
                                            $statusClass = 'bg-danger bg-opacity-10 text-danger';
                                            $statusText = 'Rechazado';
                                            break;
                                    }
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td class="text-end">
                                @if($deposit->status === 'pending')
                                    <div class="btn-group">
                                        <form action="{{ route('admin.deposits.approve', $deposit) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Aprobar" onclick="return confirm('¿Estás seguro de APROBAR este depósito?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.deposits.reject', $deposit) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Rechazar" onclick="return confirm('¿Estás seguro de RECHAZAR este depósito?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <a href="{{ route('admin.deposits.show', $deposit) }}" class="btn btn-sm btn-secondary" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No hay depósitos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($deposits->hasPages())
            <div class="mt-4">
                {{ $deposits->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.btn-success { background-color: #28a745; border-color: #28a745; }
.btn-success:hover { background-color: #218838; border-color: #1e7e34; }
.btn-danger { background-color: #dc3545; border-color: #dc3545; }
.btn-danger:hover { background-color: #c82333; border-color: #bd2130; }
</style>
@endpush 