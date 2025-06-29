@extends('layouts.admin')

@section('title', 'Detalles del Depósito')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detalles del Depósito #{{ $deposit->id }}</h5>
        <div>
            @if($deposit->status === 'pending')
                <form action="{{ route('admin.deposits.approve', $deposit) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    <button type="submit" 
                            class="btn btn-success" 
                            onclick="return confirm('¿Estás seguro de aprobar este depósito?')">
                        <i class="fas fa-check"></i> Aprobar
                    </button>
                </form>
                
                <form action="{{ route('admin.deposits.reject', $deposit) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    <button type="submit" 
                            class="btn btn-danger" 
                            onclick="return confirm('¿Estás seguro de rechazar este depósito?')">
                        <i class="fas fa-times"></i> Rechazar
                    </button>
                </form>
            @endif
            
            <a href="{{ route('admin.deposits.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-lg"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="mb-3">Información del Depósito</h6>
                <table class="table">
                    <tr>
                        <th>ID:</th>
                        <td>{{ $deposit->id }}</td>
                    </tr>
                    <tr>
                        <th>Estado:</th>
                        <td>
                            @if($deposit->status === 'pending')
                                <span class="badge bg-warning">Pendiente</span>
                            @elseif($deposit->status === 'approved')
                                <span class="badge bg-success">Aprobado</span>
                            @else
                                <span class="badge bg-danger">Rechazado</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Monto:</th>
                        <td>PEN {{ number_format($deposit->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Método de Pago:</th>
                        <td>{{ $deposit->paymentMethod->name }}</td>
                    </tr>
                    <tr>
                        <th>Número de Referencia:</th>
                        <td>{{ $deposit->reference_number }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de Creación:</th>
                        <td>{{ $deposit->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    @if($deposit->processed_at)
                        <tr>
                            <th>Fecha de Procesamiento:</th>
                            <td>{{ $deposit->processed_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endif
                </table>
            </div>
            
            <div class="col-md-6">
                <h6 class="mb-3">Información del Usuario</h6>
                <table class="table">
                    <tr>
                        <th>Nombre:</th>
                        <td>{{ $deposit->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $deposit->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td>{{ $deposit->user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Balance Actual:</th>
                        <td>PEN {{ number_format($deposit->user->balance, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($deposit->notes)
            <div class="mt-4">
                <h6>Notas</h6>
                <div class="card">
                    <div class="card-body">
                        {{ $deposit->notes }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 