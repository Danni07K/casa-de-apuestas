@extends('layouts.admin')

@section('title', 'Crear Evento Deportivo')

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

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Evento</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="home_team" class="form-label">Equipo Local</label>
                            <input type="text" class="form-control @error('home_team') is-invalid @enderror" 
                                id="home_team" name="home_team" value="{{ old('home_team') }}" required>
                            @error('home_team')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="away_team" class="form-label">Equipo Visitante</label>
                            <input type="text" class="form-control @error('away_team') is-invalid @enderror" 
                                id="away_team" name="away_team" value="{{ old('away_team') }}" required>
                            @error('away_team')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="league" class="form-label">Liga</label>
                            <input type="text" class="form-control @error('league') is-invalid @enderror" 
                                id="league" name="league" value="{{ old('league') }}" required>
                            @error('league')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Programado</option>
                                <option value="live" {{ old('status') == 'live' ? 'selected' : '' }}>En Vivo</option>
                                <option value="finished" {{ old('status') == 'finished' ? 'selected' : '' }}>Finalizado</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label">Fecha</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                id="date" name="date" value="{{ old('date') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="start_time" class="form-label">Hora</label>
                            <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                                id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="home_odds" class="form-label">Cuota Local</label>
                            <input type="number" step="0.01" class="form-control @error('home_odds') is-invalid @enderror" 
                                id="home_odds" name="home_odds" value="{{ old('home_odds') }}" required>
                            @error('home_odds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="draw_odds" class="form-label">Cuota Empate</label>
                            <input type="number" step="0.01" class="form-control @error('draw_odds') is-invalid @enderror" 
                                id="draw_odds" name="draw_odds" value="{{ old('draw_odds') }}" required>
                            @error('draw_odds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="away_odds" class="form-label">Cuota Visitante</label>
                            <input type="number" step="0.01" class="form-control @error('away_odds') is-invalid @enderror" 
                                id="away_odds" name="away_odds" value="{{ old('away_odds') }}" required>
                            @error('away_odds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar Evento
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
                    <p class="text-muted small">Ingresa los datos básicos del evento deportivo, incluyendo los equipos participantes y la liga a la que pertenecen.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-clock"></i> Fecha y Hora</h6>
                    <p class="text-muted small">Selecciona la fecha y hora exacta en que se llevará a cabo el evento. Esto es crucial para la correcta programación de las apuestas.</p>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-chart-line"></i> Cuotas</h6>
                    <p class="text-muted small">Define las cuotas para cada posible resultado. Estas determinarán las ganancias potenciales de los apostadores.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 