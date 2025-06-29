@extends('layouts.admin')

@section('title', 'Crear Tipo de Apuesta')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Tipo de Apuesta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bet-types.store') }}" method="POST">
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

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="min_selections" class="form-label">Mínimo de Selecciones</label>
                            <input type="number" class="form-control @error('min_selections') is-invalid @enderror" 
                                id="min_selections" name="min_selections" value="{{ old('min_selections', 1) }}" min="1" required>
                            @error('min_selections')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="max_selections" class="form-label">Máximo de Selecciones</label>
                            <input type="number" class="form-control @error('max_selections') is-invalid @enderror" 
                                id="max_selections" name="max_selections" value="{{ old('max_selections', 1) }}" min="1" required>
                            @error('max_selections')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="min_stake" class="form-label">Apuesta Mínima ($)</label>
                            <input type="number" step="0.01" class="form-control @error('min_stake') is-invalid @enderror" 
                                id="min_stake" name="min_stake" value="{{ old('min_stake', 1.00) }}" min="0" required>
                            @error('min_stake')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="max_stake" class="form-label">Apuesta Máxima ($)</label>
                            <input type="number" step="0.01" class="form-control @error('max_stake') is-invalid @enderror" 
                                id="max_stake" name="max_stake" value="{{ old('max_stake', 1000.00) }}" min="0" required>
                            @error('max_stake')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                {{ old('status', true) ? 'checked' : '' }}>
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
                            <i class="fas fa-save"></i> Guardar Tipo
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
                    <p class="text-muted small">Define el nombre y la descripción del tipo de apuesta. Asegúrate de que sean claros y descriptivos.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-list-ol"></i> Selecciones</h6>
                    <p class="text-muted small">Establece los límites de selecciones que los usuarios pueden hacer en este tipo de apuesta.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-dollar-sign"></i> Límites de Apuesta</h6>
                    <p class="text-muted small">Define los montos mínimos y máximos que se pueden apostar. Esto ayuda a controlar el riesgo.</p>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-toggle-on"></i> Estado</h6>
                    <p class="text-muted small">Activa o desactiva este tipo de apuesta. Los tipos inactivos no estarán disponibles para los usuarios.</p>
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