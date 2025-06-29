<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::orderBy('name')->paginate(10);
        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment-methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payment_methods',
            'description' => 'required|string',
            'type' => 'required|string|max:50',
            'status' => 'required|in:active,inactive',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0|gte:min_amount',
            'instructions' => 'required|string',
        ]);

        PaymentMethod::create($validated);

        return redirect()
            ->route('admin.payment-methods.index')
            ->with('success', 'Método de pago creado correctamente.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payment_methods,name,' . $paymentMethod->id,
            'description' => 'required|string',
            'type' => 'required|string|max:50',
            'status' => 'required|in:active,inactive',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0|gte:min_amount',
            'instructions' => 'required|string',
        ]);

        $paymentMethod->update($validated);

        return redirect()
            ->route('admin.payment-methods.index')
            ->with('success', 'Método de pago actualizado correctamente.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        // Verificar si hay depósitos asociados antes de eliminar
        if ($paymentMethod->deposits()->exists()) {
            return redirect()
                ->route('admin.payment-methods.index')
                ->with('error', 'No se puede eliminar este método de pago porque tiene depósitos asociados.');
        }

        $paymentMethod->delete();

        return redirect()
            ->route('admin.payment-methods.index')
            ->with('success', 'Método de pago eliminado correctamente.');
    }
} 