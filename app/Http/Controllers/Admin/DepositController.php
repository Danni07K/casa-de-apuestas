<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with(['user', 'paymentMethod'])
            ->latest()
            ->paginate(10);

        return view('admin.deposits.index', compact('deposits'));
    }

    public function create()
    {
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        return view('admin.deposits.create', compact('paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric|min:1',
            'reference_number' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $deposit = Deposit::create([
            'user_id' => $request->user_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'reference_number' => $request->reference_number,
            'notes' => $request->notes,
            'status' => Deposit::STATUS_PENDING
        ]);

        return redirect()
            ->route('admin.deposits.index')
            ->with('success', 'Depósito creado correctamente.');
    }

    public function show(Deposit $deposit)
    {
        $deposit->load(['user', 'paymentMethod']);
        return view('admin.deposits.show', compact('deposit'));
    }

    public function approve(Deposit $deposit)
    {
        if ($deposit->status !== Deposit::STATUS_PENDING) {
            return redirect()
                ->route('admin.deposits.index')
                ->with('error', 'Solo se pueden aprobar depósitos pendientes.');
        }

        DB::transaction(function () use ($deposit) {
            $deposit->status = Deposit::STATUS_APPROVED;
            $deposit->processed_at = now();
            $deposit->save();

            // Actualizar el balance del usuario
            $user = $deposit->user;
            $user->balance += $deposit->amount;
            $user->save();

            // Crear notificación para el usuario
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'message' => 'Tu depósito de PEN ' . number_format($deposit->amount, 2) . ' ha sido aprobado.',
                'type' => 'success'
            ]);
        });

        return redirect()
            ->route('admin.deposits.index')
            ->with('success', 'Depósito aprobado correctamente.');
    }

    public function reject(Deposit $deposit)
    {
        if ($deposit->status !== Deposit::STATUS_PENDING) {
            return redirect()
                ->route('admin.deposits.index')
                ->with('error', 'Solo se pueden rechazar depósitos pendientes.');
        }

        $deposit->status = Deposit::STATUS_REJECTED;
        $deposit->processed_at = now();
        $deposit->save();

        // Crear notificación para el usuario
        \App\Models\Notification::create([
            'user_id' => $deposit->user_id,
            'message' => 'Tu depósito de PEN ' . number_format($deposit->amount, 2) . ' ha sido rechazado.',
            'type' => 'error'
        ]);

        return redirect()
            ->route('admin.deposits.index')
            ->with('success', 'Depósito rechazado correctamente.');
    }
} 