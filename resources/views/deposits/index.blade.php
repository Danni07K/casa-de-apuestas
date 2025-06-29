@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card deposit-card">
                <div class="card-header">
                    <h5 class="mb-0">Realizar Depósito</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <h6 class="mb-3">Escanea el código QR para realizar tu depósito</h6>
                        <div class="qr-container mb-3">
                            <img src="{{ asset('images/qr.jpg') }}" 
                                 alt="Código QR para depósito" 
                                 class="img-fluid" 
                                 style="max-width: 300px;">
                        </div>
                        <p class="text-light">Escanea el código QR con tu aplicación de banca móvil</p>
                    </div>

                    <div class="alert custom-alert">
                        <h6 class="alert-heading mb-2">Instrucciones:</h6>
                        <ol class="mb-0 text-start">
                            <li>Escanea el código QR con tu aplicación de banca móvil</li>
                            <li>Verifica que el monto y los datos sean correctos</li>
                            <li>Realiza el pago</li>
                            <li>Guarda el comprobante</li>
                        </ol>
                    </div>

                    <div class="mt-4">
                        <h6 class="mb-3">Información de la cuenta</h6>
                        <div class="card account-info">
                            <div class="card-body">
                                <p class="mb-1"><strong>Banco:</strong> BCP</p>
                                <p class="mb-1"><strong>Número de Cuenta:</strong> 969365400</p>
                                <p class="mb-1"><strong>Titular:</strong> TECBET SAC</p>
                                <p class="mb-0"><strong>RUC:</strong> 20123456789</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.deposit-card {
    background: #344A73;
    border: none;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.deposit-card .card-header {
    background: #2FD35D;
    border-bottom: none;
    padding: 1.5rem;
}

.deposit-card .card-header h5 {
    color: #fff;
    font-weight: 600;
    font-size: 1.5rem;
}

.deposit-card .card-body {
    padding: 2rem;
}

.deposit-card h6 {
    color: #2FD35D;
    font-size: 1.2rem;
    font-weight: 600;
}

.qr-container {
    background: white;
    padding: 25px;
    border-radius: 15px;
    display: inline-block;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    margin: 1.5rem 0;
}

.custom-alert {
    background: rgba(47, 211, 93, 0.15);
    border: 2px solid #2FD35D;
    color: #fff;
    border-radius: 12px;
    padding: 1.5rem;
}

.custom-alert .alert-heading {
    color: #2FD35D;
    font-weight: 600;
    font-size: 1.1rem;
}

.custom-alert ol {
    color: #fff;
    padding-left: 1.2rem;
}

.custom-alert li {
    margin-bottom: 0.5rem;
}

.account-info {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid #2FD35D;
    border-radius: 12px;
}

.account-info .card-body {
    padding: 1.5rem;
}

.account-info p {
    color: #fff;
    font-size: 1.1rem;
    margin-bottom: 0.8rem;
}

.account-info strong {
    color: #2FD35D;
    font-weight: 600;
}

.text-light {
    color: #fff !important;
    font-size: 1.1rem;
}
</style>
@endsection 