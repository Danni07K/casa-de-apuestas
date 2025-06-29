@extends('layouts.admin')

@section('title', 'Editar Evento Deportivo')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Información del Evento</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.update', $event) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="home_team" class="form-label">Equipo Local</label>
                            <input type="text" class="form-control @error('home_team') is-invalid @enderror" 
                                id="home_team" name="home_team" value="{{ old('home_team', $event->home_team) }}" required>
                            @error('home_team')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="away_team" class="form-label">Equipo Visitante</label>
                            <input type="text" class="form-control @error('away_team') is-invalid @enderror" 
                                id="away_team" name="away_team" value="{{ old('away_team', $event->away_team) }}" required>
                            @error('away_team')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="league" class="form-label">Liga</label>
                            <input type="text" class="form-control @error('league') is-invalid @enderror" 
                                id="league" name="league" value="{{ old('league', $event->league) }}" required>
                            @error('league')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="scheduled" {{ old('status', $event->status) == 'scheduled' ? 'selected' : '' }}>Programado</option>
                                <option value="live" {{ old('status', $event->status) == 'live' ? 'selected' : '' }}>En Vivo</option>
                                <option value="finished" {{ old('status', $event->status) == 'finished' ? 'selected' : '' }}>Finalizado</option>
                                <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
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
                                id="date" name="date" value="{{ old('date', $event->date->format('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="start_time" class="form-label">Hora</label>
                            <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                                id="start_time" name="start_time" value="{{ old('start_time', $event->start_time->format('H:i')) }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3" id="result-fields" style="display: {{ old('status', $event->status) == 'finished' ? '' : 'none' }};">
                        <div class="col-md-4">
                            <label class="form-label">Ganador 1x2</label>
                            <select class="form-select" name="result_1x2" id="result_1x2">
                                <option value="">-- Selecciona --</option>
                                <option value="local" {{ old('result_1x2', $event->result) == 'local' ? 'selected' : '' }}>{{ $event->home_team }}</option>
                                <option value="empate" {{ old('result_1x2', $event->result) == 'empate' ? 'selected' : '' }}>Empate</option>
                                <option value="visitante" {{ old('result_1x2', $event->result) == 'visitante' ? 'selected' : '' }}>{{ $event->away_team }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Primer Gol</label>
                            <select class="form-select" name="result_primer_gol" id="result_primer_gol">
                                <option value="">-- Selecciona --</option>
                                <option value="primer_gol:{{ $event->home_team }}" {{ old('result_primer_gol', $event->result) == 'primer_gol:'.$event->home_team ? 'selected' : '' }}>{{ $event->home_team }}</option>
                                <option value="primer_gol:{{ $event->away_team }}" {{ old('result_primer_gol', $event->result) == 'primer_gol:'.$event->away_team ? 'selected' : '' }}>{{ $event->away_team }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ambos Marcan</label>
                            <select class="form-select" name="result_ambos_marcan" id="result_ambos_marcan">
                                <option value="">-- Selecciona --</option>
                                <option value="ambos_marcan:SI" {{ old('result_ambos_marcan', $event->result) == 'ambos_marcan:SI' ? 'selected' : '' }}>Sí</option>
                                <option value="ambos_marcan:NO" {{ old('result_ambos_marcan', $event->result) == 'ambos_marcan:NO' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="home_odds" class="form-label">Cuota Local</label>
                            <input type="number" step="0.01" class="form-control @error('home_odds') is-invalid @enderror" 
                                id="home_odds" name="home_odds" value="{{ old('home_odds', $event->home_odds) }}" required>
                            @error('home_odds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="draw_odds" class="form-label">Cuota Empate</label>
                            <input type="number" step="0.01" class="form-control @error('draw_odds') is-invalid @enderror" 
                                id="draw_odds" name="draw_odds" value="{{ old('draw_odds', $event->draw_odds) }}" required>
                            @error('draw_odds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="away_odds" class="form-label">Cuota Visitante</label>
                            <input type="number" step="0.01" class="form-control @error('away_odds') is-invalid @enderror" 
                                id="away_odds" name="away_odds" value="{{ old('away_odds', $event->away_odds) }}" required>
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
                            <i class="fas fa-save"></i> Actualizar Evento
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
                        @switch($event->status)
                            @case('scheduled')
                                <span class="badge bg-primary">Programado</span>
                                @break
                            @case('live')
                                <span class="badge bg-success">En Vivo</span>
                                @break
                            @case('finished')
                                <span class="badge bg-secondary">Finalizado</span>
                                @break
                            @case('cancelled')
                                <span class="badge bg-danger">Cancelado</span>
                                @break
                        @endswitch
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Fecha</h6>
                        <span class="text-muted">{{ $event->date->format('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Cuotas Actuales</h6>
                        <div class="d-flex gap-2">
                            <span class="badge bg-success">{{ $event->home_odds }}</span>
                            <span class="badge bg-success">{{ $event->draw_odds }}</span>
                            <span class="badge bg-success">{{ $event->away_odds }}</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-1">Hora</h6>
                        <span class="text-muted">{{ $event->start_time->format('H:i') }}</span>
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
                    <p class="text-muted small">Modifica los datos básicos del evento deportivo según sea necesario.</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-success"><i class="fas fa-exclamation-triangle"></i> Cambios de Estado</h6>
                    <p class="text-muted small">Ten en cuenta que cambiar el estado del evento puede afectar las apuestas existentes.</p>
                </div>

                <div>
                    <h6 class="text-success"><i class="fas fa-chart-line"></i> Cuotas</h6>
                    <p class="text-muted small">Actualiza las cuotas con precaución, ya que esto impactará en las ganancias potenciales.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('status').addEventListener('change', function() {
    document.getElementById('result-fields').style.display = this.value === 'finished' ? '' : 'none';
});
// Al enviar el formulario, prioriza el resultado seleccionado
const form = document.querySelector('form');
form.addEventListener('submit', function(e) {
    if(document.getElementById('status').value === 'finished') {
        let res = document.getElementById('result_1x2').value || document.getElementById('result_primer_gol').value || document.getElementById('result_ambos_marcan').value;
        if(!res) {
            alert('Debes seleccionar un resultado para finalizar el evento.');
            e.preventDefault();
            return false;
        }
        let hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'result';
        hidden.value = res;
        form.appendChild(hidden);
    }
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