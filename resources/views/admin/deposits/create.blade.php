@extends('layouts.admin')

@section('title', 'Nuevo Depósito')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Nuevo Depósito</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.deposits.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Usuario</label>
                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach(\App\Models\User::where('role', 'user')->get() as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="payment_method_id" class="form-label">Método de Pago</label>
                <select name="payment_method_id" id="payment_method_id" class="form-select @error('payment_method_id') is-invalid @enderror" required>
                    <option value="">Seleccione un método de pago</option>
                    @foreach($paymentMethods as $method)
                        <option value="{{ $method->id }}" {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                            {{ $method->name }}
                        </option>
                    @endforeach
                </select>
                @error('payment_method_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Monto</label>
                <div class="input-group">
                    <span class="input-group-text">PEN</span>
                    <input type="number" 
                           class="form-control @error('amount') is-invalid @enderror" 
                           id="amount" 
                           name="amount" 
                           value="{{ old('amount') }}" 
                           step="0.01" 
                           min="1" 
                           required>
                </div>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="reference_number" class="form-label">Número de Referencia</label>
                <input type="text" 
                       class="form-control @error('reference_number') is-invalid @enderror" 
                       id="reference_number" 
                       name="reference_number" 
                       value="{{ old('reference_number') }}" 
                       required>
                @error('reference_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notas</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" 
                          id="notes" 
                          name="notes" 
                          rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.deposits.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left fa-lg"></i> Volver
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Depósito
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 