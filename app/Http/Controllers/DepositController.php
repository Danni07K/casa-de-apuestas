<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        return view('deposits.index', compact('paymentMethods'));
    }

    public function wallet()
    {
        // SIMULACIÓN DE DATOS
        $yape = (object)['name' => 'Yape', 'logo' => 'yape.png'];
        $bcp = (object)['name' => 'BCP', 'logo' => 'bcp.png'];
        $plin = (object)['name' => 'Plin', 'logo' => 'plin.png'];

        $fakeDepositsData = [
            (object)[
                'created_at' => now()->subDays(1)->setTime(14, 30),
                'paymentMethod' => $yape,
                'amount' => 50.00,
                'status' => 'aprobado'
            ],
            (object)[
                'created_at' => now()->subDays(3)->setTime(9, 15),
                'paymentMethod' => $bcp,
                'amount' => 120.50,
                'status' => 'aprobado'
            ],
            (object)[
                'created_at' => now()->subDays(5)->setTime(18, 0),
                'paymentMethod' => $plin,
                'amount' => 75.00,
                'status' => 'pendiente'
            ],
            (object)[
                'created_at' => now()->subDays(7)->setTime(11, 45),
                'paymentMethod' => $yape,
                'amount' => 200.00,
                'status' => 'rechazado'
            ],
            (object)[
                'created_at' => now()->subDays(10)->setTime(20, 5),
                'paymentMethod' => $bcp,
                'amount' => 30.00,
                'status' => 'aprobado'
            ],
        ];

        $depositsCollection = new Collection($fakeDepositsData);
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage('page');
        $currentPageItems = $depositsCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $deposits = new LengthAwarePaginator($currentPageItems, count($depositsCollection), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        
        return view('wallet.index', compact('deposits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric|min:1',
            'reference_number' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);

        // Validar límites de monto
        if ($request->amount < $paymentMethod->min_amount || $request->amount > $paymentMethod->max_amount) {
            return back()->with('error', 'El monto debe estar entre PEN ' . 
                number_format($paymentMethod->min_amount, 2) . ' y PEN ' . 
                number_format($paymentMethod->max_amount, 2));
        }

        $deposit = Deposit::create([
            'user_id' => auth()->id(),
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'reference_number' => $request->reference_number,
            'notes' => $request->notes,
            'status' => Deposit::STATUS_PENDING
        ]);

        return redirect()
            ->route('deposits.index')
            ->with('success', 'Depósito registrado correctamente. Estará pendiente de aprobación.');
    }
} 