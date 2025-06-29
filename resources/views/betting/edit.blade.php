@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Editar Apuesta</h2>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('betting.update', $betting) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="event_id" class="form-label">Evento</label>
                            <select class="form-control @error('event_id') is-invalid @enderror" id="event_id" name="event_id" required>
                                <option value="">Selecciona un evento</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" {{ (old('event_id', $betting->event_id) == $event->id) ? 'selected' : '' }}>
                                        {{ $event->home_team }} vs {{ $event->away_team }} - {{ $event->start_time->format('d/m/Y H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('event_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Monto de la apuesta</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $betting->amount) }}" required min="1" step="0.01">
                            </div>
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Actualizar Apuesta
                            </button>
                            <a href="{{ route('betting.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 