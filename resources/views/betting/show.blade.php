@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Detalles de la Apuesta</h2>
                        <a href="{{ route('betting.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Información del Evento</h4>
                            <p><strong>Equipos:</strong> {{ $betting->event->home_team }} vs {{ $betting->event->away_team }}</p>
                            <p><strong>Fecha y Hora:</strong> {{ $betting->event->start_time->format('d/m/Y H:i') }}</p>
                            <p><strong>Estado del Evento:</strong> 
                                @if($betting->event->status === 'scheduled')
                                    <span class="badge bg-warning">Programado</span>
                                @elseif($betting->event->status === 'live')
                                    <span class="badge bg-info">En Vivo</span>
                                @else
                                    <span class="badge bg-success">Finalizado</span>
                                @endif
                            </p>
                            @if($betting->event->status === 'finished')
                                <p><strong>Resultado:</strong> {{ $betting->event->result }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4>Información de la Apuesta</h4>
                            <p><strong>Monto:</strong> ${{ number_format($betting->amount, 2) }}</p>
                            <p><strong>Estado:</strong>
                                @if($betting->status === 'pending')
                                    <span class="badge bg-warning">Pendiente</span>
                                @elseif($betting->status === 'won')
                                    <span class="badge bg-success">Ganada</span>
                                @else
                                    <span class="badge bg-danger">Perdida</span>
                                @endif
                            </p>
                            <p><strong>Fecha de Creación:</strong> {{ $betting->created_at->format('d/m/Y H:i') }}</p>
                            @if($betting->updated_at != $betting->created_at)
                                <p><strong>Última Actualización:</strong> {{ $betting->updated_at->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 