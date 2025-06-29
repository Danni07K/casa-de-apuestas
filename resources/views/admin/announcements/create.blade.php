@extends('layouts.admin')

@section('title', 'Crear Anuncio')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Anuncio</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.announcements.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                            id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                            id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                            id="type" name="type" required>
                            <option value="">Selecciona un tipo...</option>
                            <option value="info" {{ old('type') == 'info' ? 'selected' : '' }}>Información</option>
                            <option value="warning" {{ old('type') == 'warning' ? 'selected' : '' }}>Advertencia</option>
                            <option value="success" {{ old('type') == 'success' ? 'selected' : '' }}>Éxito</option>
                            <option value="danger" {{ old('type') == 'danger' ? 'selected' : '' }}>Importante</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                id="start_date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                id="end_date" name="end_date" value="{{ old('end_date', now()->addDays(7)->format('Y-m-d')) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                {{ old('is_active', true) ? 'checked' : '' }}>
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
                            <i class="fas fa-save"></i> Guardar Anuncio
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
                    <p class="text-muted small">Define el título y contenido del anuncio. Asegúrate de que sean claros y concisos.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-tags"></i> Tipos de Anuncio</h6>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2">
                            <span class="badge bg-info">Información</span>
                            <div>Para noticias y actualizaciones generales.</div>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-warning">Advertencia</span>
                            <div>Para alertas y avisos importantes.</div>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-success">Éxito</span>
                            <div>Para anunciar logros o cambios positivos.</div>
                        </li>
                        <li>
                            <span class="badge bg-danger">Importante</span>
                            <div>Para información crítica o urgente.</div>
                        </li>
                    </ul>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-calendar-alt"></i> Fechas</h6>
                    <p class="text-muted small">Establece el período durante el cual el anuncio estará visible para los usuarios.</p>
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