@extends('layouts.admin')

@section('title', 'Editar Anuncio')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Anuncio</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                            id="title" name="title" value="{{ old('title', $announcement->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                            id="content" name="content" rows="5" required>{{ old('content', $announcement->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                            id="type" name="type" required>
                            <option value="">Selecciona un tipo...</option>
                            <option value="info" {{ old('type', $announcement->type) == 'info' ? 'selected' : '' }}>Información</option>
                            <option value="warning" {{ old('type', $announcement->type) == 'warning' ? 'selected' : '' }}>Advertencia</option>
                            <option value="success" {{ old('type', $announcement->type) == 'success' ? 'selected' : '' }}>Éxito</option>
                            <option value="danger" {{ old('type', $announcement->type) == 'danger' ? 'selected' : '' }}>Importante</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                id="start_date" name="start_date" value="{{ old('start_date', $announcement->start_date->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                id="end_date" name="end_date" value="{{ old('end_date', $announcement->end_date->format('Y-m-d')) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Activo</label>
                        </div>
                        @error('is_active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar Anuncio
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
                        @if($announcement->is_active)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Tipo</h6>
                        @switch($announcement->type)
                            @case('info')
                                <span class="badge bg-info">Información</span>
                                @break
                            @case('warning')
                                <span class="badge bg-warning">Advertencia</span>
                                @break
                            @case('success')
                                <span class="badge bg-success">Éxito</span>
                                @break
                            @case('danger')
                                <span class="badge bg-danger">Importante</span>
                                @break
                        @endswitch
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Inicio</h6>
                        <span class="text-muted">{{ $announcement->start_date->format('d/m/Y') }}</span>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Fin</h6>
                        <span class="text-muted">{{ $announcement->end_date->format('d/m/Y') }}</span>
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
                    <p class="text-muted small">Modifica los datos básicos del anuncio según sea necesario.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-exclamation-triangle"></i> Cambios de Estado</h6>
                    <p class="text-muted small">Ten en cuenta que desactivar un anuncio lo ocultará de los usuarios.</p>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-calendar-alt"></i> Fechas</h6>
                    <p class="text-muted small">Ajusta las fechas de inicio y fin para controlar la visibilidad del anuncio.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Validación en tiempo real para asegurar que end_date > start_date
document.getElementById('start_date').addEventListener('input', function() {
    const endDateInput = document.getElementById('end_date');
    if (this.value >= endDateInput.value) {
        const startDate = new Date(this.value);
        startDate.setDate(startDate.getDate() + 1);
        endDateInput.value = startDate.toISOString().split('T')[0];
    }
    endDateInput.min = this.value;
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