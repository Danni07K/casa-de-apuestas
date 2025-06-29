@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark border-success">
                <div class="card-header bg-dark border-bottom border-success">
                    <h4 class="mb-0 text-success">Mi Perfil</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label text-white">Nombre</label>
                            <input id="name" type="text" class="form-control bg-dark text-white @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-white">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control bg-dark text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <hr class="border-success my-4">

                        <h5 class="text-success mb-3">Cambiar Contraseña</h5>

                        <div class="mb-3">
                            <label for="current_password" class="form-label text-white">Contraseña Actual</label>
                            <input id="current_password" type="password" class="form-control bg-dark text-white @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label text-white">Nueva Contraseña</label>
                            <input id="new_password" type="password" class="form-control bg-dark text-white @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label text-white">Confirmar Nueva Contraseña</label>
                            <input id="new_password_confirmation" type="password" class="form-control bg-dark text-white" name="new_password_confirmation" autocomplete="new-password">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                Actualizar Perfil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    background-color: #1a1f35;
    border-color: #2FD35D;
    box-shadow: 0 0 0 0.25rem rgba(47, 211, 93, 0.25);
    color: white;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.btn-success {
    background-color: #2FD35D;
    border-color: #2FD35D;
}

.btn-success:hover {
    background-color: #28b850;
    border-color: #28b850;
    transform: translateY(-1px);
}

.alert-success {
    background-color: rgba(47, 211, 93, 0.1);
    border-color: #2FD35D;
    color: #2FD35D;
}
</style>
@endsection 