<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BetType;
use Illuminate\Http\Request;

class BetTypeController extends Controller
{
    public function index()
    {
        $betTypes = BetType::orderBy('name')->paginate(10);
        return view('admin.bet-types.index', compact('betTypes'));
    }

    public function create()
    {
        return view('admin.bet-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:bet_types',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'min_selections' => 'required|integer|min:1',
            'max_selections' => 'required|integer|min:1|gte:min_selections',
            'min_stake' => 'required|numeric|min:0',
            'max_stake' => 'required|numeric|min:0|gte:min_stake',
        ]);

        BetType::create($validated);

        return redirect()
            ->route('admin.bet-types.index')
            ->with('success', 'Tipo de apuesta creado correctamente.');
    }

    public function edit(BetType $betType)
    {
        return view('admin.bet-types.edit', compact('betType'));
    }

    public function update(Request $request, BetType $betType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:bet_types,name,' . $betType->id,
            'description' => 'required|string',
            'status' => 'required|boolean',
            'min_selections' => 'required|integer|min:1',
            'max_selections' => 'required|integer|min:1|gte:min_selections',
            'min_stake' => 'required|numeric|min:0',
            'max_stake' => 'required|numeric|min:0|gte:min_stake',
        ]);

        $betType->update($validated);

        return redirect()
            ->route('admin.bet-types.index')
            ->with('success', 'Tipo de apuesta actualizado correctamente.');
    }

    public function destroy(BetType $betType)
    {
        // Verificar si hay apuestas asociadas antes de eliminar
        if ($betType->bets()->exists()) {
            return redirect()
                ->route('admin.bet-types.index')
                ->with('error', 'No se puede eliminar este tipo de apuesta porque tiene apuestas asociadas.');
        }

        $betType->delete();

        return redirect()
            ->route('admin.bet-types.index')
            ->with('success', 'Tipo de apuesta eliminado correctamente.');
    }
} 