@extends('layouts.app')

@section('title', 'Mi Billetera - TecBet')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="wallet-card">
                <div class="wallet-header">
                    <h1 class="wallet-title"><i class="fas fa-wallet"></i> Mi Billetera</h1>
                    <div class="balance-display">
                        <span class="balance-label">Saldo Actual</span>
                        <span class="balance-amount">PEN {{ number_format(auth()->user()->balance, 2) }}</span>
                    </div>
                </div>

                <div class="wallet-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="history-title">Historial de Depósitos</h2>
                        <a href="{{ route('user.deposits.index') }}" class="btn btn-deposit-new"><i class="fas fa-plus-circle"></i> Realizar un Depósito</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover transaction-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Método de Pago</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $deposit)
                                    <tr>
                                        <td>{{ $deposit->created_at->format('d/m/Y H:i A') }}</td>
                                        <td>
                                            @if($deposit->paymentMethod)
                                                {{ $deposit->paymentMethod->name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="amount-positive">+ PEN {{ number_format($deposit->amount, 2) }}</td>
                                        <td>
                                            <span class="badge status-{{ strtolower($deposit->status) }}">
                                                {{ ucfirst($deposit->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <p class="mb-2"><i class="fas fa-receipt fa-2x text-muted"></i></p>
                                            <p class="mb-0">Aún no has realizado ningún depósito.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $deposits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
body {
    background-color: #121314;
    color: #fff;
}
.wallet-card {
    background-color: #1a1e23;
    border: 1px solid #2fd35d33;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(47, 211, 93, 0.1);
}
.wallet-header {
    background: linear-gradient(45deg, #1f2c38, #232b47);
    padding: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #2fd35d55;
}
.wallet-title {
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    margin: 0;
}
.wallet-title i {
    color: #2fd35d;
    margin-right: 15px;
}
.balance-display {
    text-align: right;
}
.balance-label {
    display: block;
    font-size: 0.9rem;
    color: #a0a0a0;
    margin-bottom: 5px;
}
.balance-amount {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2fd35d;
}
.wallet-body {
    padding: 30px;
}
.history-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #e0e0e0;
    border-left: 4px solid #2fd35d;
    padding-left: 15px;
}
.btn-deposit-new {
    background-color: #2fd35d;
    color: #121314;
    font-weight: 600;
    border-radius: 50px;
    padding: 10px 25px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    font-size: 0.9rem;
    border: none;
}
.btn-deposit-new:hover {
    background-color: #fff;
    color: #121314;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(47, 211, 93, 0.3);
}
.transaction-table {
    width: 100%;
    color: #c0c0c0;
}
.transaction-table thead {
    border-bottom: 2px solid #2a313e;
}
.transaction-table th {
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    padding: 15px;
    border: none;
}
.transaction-table td {
    padding: 20px 15px;
    vertical-align: middle;
    border-top: 1px solid #2a313e;
    font-size: 0.95rem;
}
.amount-positive {
    color: #2fd35d;
    font-weight: 600;
}
.badge {
    padding: 8px 12px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
}
.status-completed, .status-aprobado {
    background-color: rgba(47, 211, 93, 0.1);
    color: #2fd35d;
}
.status-pending, .status-pendiente {
    background-color: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}
.status-failed, .status-rechazado {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}
.pagination .page-link {
    background-color: #1f2c38;
    border: 1px solid #2a313e;
    color: #c0c0c0;
}
.pagination .page-link:hover {
    background-color: #2fd35d;
    color: #121314;
}
.pagination .page-item.active .page-link {
    background-color: #2fd35d;
    border-color: #2fd35d;
    color: #121314;
}
</style>
@endpush 