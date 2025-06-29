@extends('layouts.admin')

@section('title', 'Crear Método de Pago')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Método de Pago</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payment-methods.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                            id="type" name="type" required>
                            <option value="">Selecciona un tipo...</option>
                            <option value="bank_transfer" {{ old('type') == 'bank_transfer' ? 'selected' : '' }}>Transferencia Bancaria</option>
                            <option value="credit_card" {{ old('type') == 'credit_card' ? 'selected' : '' }}>Tarjeta de Crédito</option>
                            <option value="debit_card" {{ old('type') == 'debit_card' ? 'selected' : '' }}>Tarjeta de Débito</option>
                            <option value="e_wallet" {{ old('type') == 'e_wallet' ? 'selected' : '' }}>Billetera Electrónica</option>
                            <option value="crypto" {{ old('type') == 'crypto' ? 'selected' : '' }}>Criptomoneda</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="min_amount" class="form-label">Monto Mínimo ($)</label>
                            <input type="number" step="0.01" class="form-control @error('min_amount') is-invalid @enderror" 
                                id="min_amount" name="min_amount" value="{{ old('min_amount', 10.00) }}" min="0" required>
                            @error('min_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="max_amount" class="form-label">Monto Máximo ($)</label>
                            <input type="number" step="0.01" class="form-control @error('max_amount') is-invalid @enderror" 
                                id="max_amount" name="max_amount" value="{{ old('max_amount', 10000.00) }}" min="0" required>
                            @error('max_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instrucciones de Pago</label>
                        <textarea class="form-control @error('instructions') is-invalid @enderror" 
                            id="instructions" name="instructions" rows="4" required>{{ old('instructions') }}</textarea>
                        <small class="text-muted">Proporciona instrucciones claras sobre cómo realizar el pago usando este método.</small>
                        @error('instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activo</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
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
                            <i class="fas fa-save"></i> Guardar Método
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ayuda</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-info-circle"></i> Información General</h6>
                    <p class="text-muted small">Define el nombre y la descripción del método de pago. Asegúrate de que sean claros y descriptivos.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-money-bill-wave"></i> Límites de Monto</h6>
                    <p class="text-muted small">Establece los montos mínimos y máximos que los usuarios pueden depositar usando este método.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-list-ul"></i> Instrucciones</h6>
                    <p class="text-muted small">Proporciona instrucciones detalladas y paso a paso sobre cómo realizar el pago.</p>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-toggle-on"></i> Estado</h6>
                    <p class="text-muted small">Activa o desactiva este método de pago. Los métodos inactivos no estarán disponibles para los usuarios.</p>
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