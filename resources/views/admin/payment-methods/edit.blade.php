@extends('layouts.admin')

@section('title', 'Editar Método de Pago')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Método de Pago</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payment-methods.update', $paymentMethod) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name', $paymentMethod->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3" required>{{ old('description', $paymentMethod->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                            id="type" name="type" required>
                            <option value="">Selecciona un tipo...</option>
                            <option value="bank_transfer" {{ old('type', $paymentMethod->type) == 'bank_transfer' ? 'selected' : '' }}>Transferencia Bancaria</option>
                            <option value="credit_card" {{ old('type', $paymentMethod->type) == 'credit_card' ? 'selected' : '' }}>Tarjeta de Crédito</option>
                            <option value="debit_card" {{ old('type', $paymentMethod->type) == 'debit_card' ? 'selected' : '' }}>Tarjeta de Débito</option>
                            <option value="e_wallet" {{ old('type', $paymentMethod->type) == 'e_wallet' ? 'selected' : '' }}>Billetera Electrónica</option>
                            <option value="crypto" {{ old('type', $paymentMethod->type) == 'crypto' ? 'selected' : '' }}>Criptomoneda</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="min_amount" class="form-label">Monto Mínimo ($)</label>
                            <input type="number" step="0.01" class="form-control @error('min_amount') is-invalid @enderror" 
                                id="min_amount" name="min_amount" value="{{ old('min_amount', $paymentMethod->min_amount) }}" min="0" required>
                            @error('min_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="max_amount" class="form-label">Monto Máximo ($)</label>
                            <input type="number" step="0.01" class="form-control @error('max_amount') is-invalid @enderror" 
                                id="max_amount" name="max_amount" value="{{ old('max_amount', $paymentMethod->max_amount) }}" min="0" required>
                            @error('max_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instrucciones de Pago</label>
                        <textarea class="form-control @error('instructions') is-invalid @enderror" 
                            id="instructions" name="instructions" rows="4" required>{{ old('instructions', $paymentMethod->instructions) }}</textarea>
                        <small class="text-muted">Proporciona instrucciones claras sobre cómo realizar el pago usando este método.</small>
                        @error('instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                            <option value="active" {{ old('status', $paymentMethod->status) == 'active' ? 'selected' : '' }}>Activo</option>
                            <option value="inactive" {{ old('status', $paymentMethod->status) == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar Método
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Estado Actual</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="mb-1">Estado</h6>
                        @if($paymentMethod->status === 'active')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Depósitos</h6>
                        <span class="badge bg-primary">{{ $paymentMethod->deposits()->count() }}</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Tipo</h6>
                        <span class="badge bg-success">{{ $paymentMethod->type }}</span>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Límites ($)</h6>
                        <div class="d-flex gap-2 justify-content-end">
                            <span class="badge bg-success">{{ number_format($paymentMethod->min_amount, 2) }}</span>
                            <span class="badge bg-success">{{ number_format($paymentMethod->max_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ayuda</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-info-circle"></i> Información General</h6>
                    <p class="text-muted small">Modifica los datos básicos del método de pago según sea necesario.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-exclamation-triangle"></i> Cambios de Estado</h6>
                    <p class="text-muted small">Ten en cuenta que desactivar un método de pago afectará a los usuarios que lo utilizan.</p>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-chart-line"></i> Límites</h6>
                    <p class="text-muted small">Ajusta los límites con precaución, ya que esto impactará en los montos que los usuarios pueden depositar.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Validación en tiempo real para asegurar que max_amount >= min_amount
document.getElementById('min_amount').addEventListener('input', function() {
    const maxAmountInput = document.getElementById('max_amount');
    if (parseFloat(this.value) > parseFloat(maxAmountInput.value)) {
        maxAmountInput.value = this.value;
    }
    maxAmountInput.min = this.value;
});
</script>
@endsection

@section('styles')
<style>
    body, .card, .card-header, .card-body, .card-footer {
        color: #fff !important;
    }
    label, .form-label, .input-group-text, .invalid-feedback, .text-muted, .text-success, .text-end, .help-block, .form-text, .small, .mb-0, .mb-1, .mb-2, .mb-3, .mb-4, .h5, .h6, .h4, .h3, .h2, .h1 {
        color: #fff !important;
    }
    .form-control, .form-select, select, option, textarea, input[type="text"], input[type="number"], input[type="date"], input[type="time"] {
        background: #232b47 !important;
        color: #fff !important;
        border-color: #2FD35D !important;
    }
    .form-control::placeholder, textarea::placeholder {
        color: #aaa !important;
    }
    .input-group-text {
        background: #232b47 !important;
        color: #fff !important;
        border-color: #2FD35D !important;
    }
    .card {
        background: #181c2f !important;
    }
    .btn, .btn-outline-secondary, .btn-success {
        color: #fff !important;
    }
    select option { color: #111 !important; background: #fff !important; }
</style>
@endsection 