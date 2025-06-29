@extends('layouts.admin')

@section('title', 'Editar Tipo de Apuesta')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Tipo de Apuesta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bet-types.update', $betType) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name', $betType->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3" required>{{ old('description', $betType->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="min_selections" class="form-label">Mínimo de Selecciones</label>
                            <input type="number" class="form-control @error('min_selections') is-invalid @enderror" 
                                id="min_selections" name="min_selections" value="{{ old('min_selections', $betType->min_selections) }}" min="1" required>
                            @error('min_selections')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="max_selections" class="form-label">Máximo de Selecciones</label>
                            <input type="number" class="form-control @error('max_selections') is-invalid @enderror" 
                                id="max_selections" name="max_selections" value="{{ old('max_selections', $betType->max_selections) }}" min="1" required>
                            @error('max_selections')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="min_stake" class="form-label">Apuesta Mínima ($)</label>
                            <input type="number" step="0.01" class="form-control @error('min_stake') is-invalid @enderror" 
                                id="min_stake" name="min_stake" value="{{ old('min_stake', $betType->min_stake) }}" min="0" required>
                            @error('min_stake')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="max_stake" class="form-label">Apuesta Máxima ($)</label>
                            <input type="number" step="0.01" class="form-control @error('max_stake') is-invalid @enderror" 
                                id="max_stake" name="max_stake" value="{{ old('max_stake', $betType->max_stake) }}" min="0" required>
                            @error('max_stake')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                {{ old('status', $betType->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Activo</label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.bet-types.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar Tipo
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
                        @if($betType->status)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Apuestas Activas</h6>
                        <span class="badge bg-primary">{{ $betType->bets()->count() }}</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Selecciones</h6>
                        <div class="d-flex gap-2">
                            <span class="badge bg-success">Mín: {{ $betType->min_selections }}</span>
                            <span class="badge bg-success">Máx: {{ $betType->max_selections }}</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Límites ($)</h6>
                        <div class="d-flex gap-2 justify-content-end">
                            <span class="badge bg-success">{{ number_format($betType->min_stake, 2) }}</span>
                            <span class="badge bg-success">{{ number_format($betType->max_stake, 2) }}</span>
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
                    <p class="text-muted small">Modifica los datos básicos del tipo de apuesta según sea necesario.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-exclamation-triangle"></i> Cambios de Estado</h6>
                    <p class="text-muted small">Ten en cuenta que desactivar un tipo de apuesta afectará a las apuestas existentes.</p>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-chart-line"></i> Límites</h6>
                    <p class="text-muted small">Ajusta los límites con precaución, ya que esto impactará en las apuestas que los usuarios pueden realizar.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Validación en tiempo real para asegurar que max_selections >= min_selections
document.getElementById('min_selections').addEventListener('input', function() {
    const maxSelectionsInput = document.getElementById('max_selections');
    if (parseInt(this.value) > parseInt(maxSelectionsInput.value)) {
        maxSelectionsInput.value = this.value;
    }
    maxSelectionsInput.min = this.value;
});

// Validación en tiempo real para asegurar que max_stake >= min_stake
document.getElementById('min_stake').addEventListener('input', function() {
    const maxStakeInput = document.getElementById('max_stake');
    if (parseFloat(this.value) > parseFloat(maxStakeInput.value)) {
        maxStakeInput.value = this.value;
    }
    maxStakeInput.min = this.value;
});
</script>
@endsection

@section('styles')
<style>
    body, label, .form-label, .form-control, .form-select, .card, .card-header, .card-body, .card-footer, .text-muted, .text-success, .text-end, .input-group-text, .invalid-feedback, .btn, .btn-outline-secondary, .btn-success {
        color: #fff !important;
    }
    .form-control, .form-select {
        background: #232b47 !important;
        color: #fff !important;
        border-color: #2FD35D;
    }
    .form-control::placeholder {
        color: #aaa !important;
    }
    .input-group-text {
        background: #232b47 !important;
        color: #fff !important;
        border-color: #2FD35D;
    }
    .card {
        background: #181c2f !important;
    }
</style>
@endsection 