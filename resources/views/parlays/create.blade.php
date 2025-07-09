@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="fas fa-layer-group text-success me-2"></i>
                    <h3 class="mb-0">Crear Parlay</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('parlays.store') }}">
                        @csrf
                        <div class="mb-4">
                            <p class="text-muted mb-4">Combina múltiples apuestas para maximizar tus ganancias y vive la emoción de los grandes apostadores</p>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="stat-card text-center p-4">
                                    <i class="fas fa-wallet text-warning mb-2"></i>
                                    <div class="fw-bold">Saldo</div>
                                    <div class="display-6">PEN {{ number_format(auth()->user()->balance ?? 0, 2) }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card text-center p-4">
                                    <i class="fas fa-percentage text-success mb-2"></i>
                                    <div class="fw-bold">Cuota Total</div>
                                    <div class="display-6" id="total-odds">0.00</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card text-center p-4">
                                    <i class="fas fa-coins text-primary mb-2"></i>
                                    <div class="fw-bold">Ganancia Potencial</div>
                                    <div class="display-6" id="potential-win">0.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="bet-amount" class="form-label">Monto a Apostar</label>
                            <div class="input-group">
                                <input type="number" name="amount" id="bet-amount" step="0.01" min="1" class="form-control bg-dark text-white border-0" placeholder="Ingresa el monto" required>
                                <span class="input-group-text bg-dark text-muted border-0">PEN</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5 class="mb-3">Selecciones</h5>
                            <div id="selections-list"></div>
                            <div class="text-center mb-4">
                                <button type="button" id="add-selection" class="btn btn-primary btn-lg px-5">Agregar Selección</button>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="submit-parlay" disabled class="btn btn-success btn-lg px-5 fw-bold">Crear Parlay</button>
                        </div>
                    </form>
                    <div class="mt-5">
                        <h5><i class="fas fa-lightbulb me-2 text-warning"></i> Tips para tu Parlay</h5>
                        <ul class="text-muted mb-0">
                            <li>Combina apuestas de diferentes eventos para mejores cuotas.</li>
                            <li>No apuestes más de lo que puedes permitirte perder.</li>
                            <li>Revisa las estadísticas antes de seleccionar tus apuestas.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// JS para manejar dinámicamente las selecciones (puedes restaurar el script original aquí)
</script>
@endsection
