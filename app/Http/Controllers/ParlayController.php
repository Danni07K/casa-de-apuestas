<?php

namespace App\Http\Controllers;

use App\Models\Parlay;
use App\Models\ParlaySelection;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParlayController extends Controller
{
    public function index()
    {
        $parlays = Auth::user()->parlays()
            ->with(['selections.event'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('parlays.index', compact('parlays'));
    }

    public function create()
    {
        $events = Event::where('status', 'scheduled')
            ->where('start_time', '>', now()->addMinutes(5))
            ->orderBy('start_time')
            ->get(['id', 'home_team', 'away_team', 'league', 'start_time', 'home_odds', 'draw_odds', 'away_odds'])
            ->map(function($event) {
                return [
                    'id' => $event->id,
                    'home_team' => $event->home_team,
                    'away_team' => $event->away_team,
                    'league' => $event->league,
                    'start_time' => $event->start_time,
                    'home_odds' => $event->home_odds,
                    'draw_odds' => $event->draw_odds,
                    'away_odds' => $event->away_odds,
                ];
            })->values()->toArray();

        return view('parlays.create', [
            'events' => $events,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'selections' => 'required|array|min:2|max:10',
            'selections.*.event_id' => 'required|exists:events,id',
            'selections.*.bet_type' => 'required|in:1x2,primer_gol,ambos_marcan',
            'selections.*.selection' => 'required|string',
            'selections.*.odds' => 'required|numeric|min:1.01',
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();

        // Verificar saldo
        if ($user->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Saldo insuficiente']);
        }

        // Calcular cuotas totales
        $totalOdds = 1;
        foreach ($validated['selections'] as $selection) {
            $totalOdds *= $selection['odds'];
        }

        $potentialWin = $validated['amount'] * $totalOdds;

        DB::transaction(function () use ($validated, $user, $totalOdds, $potentialWin) {
            // Crear parlay
            $parlay = Parlay::create([
                'user_id' => $user->id,
                'total_odds' => $totalOdds,
                'amount' => $validated['amount'],
                'potential_win' => $potentialWin,
                'total_selections' => count($validated['selections']),
            ]);

            // Crear selecciones
            foreach ($validated['selections'] as $selection) {
                ParlaySelection::create([
                    'parlay_id' => $parlay->id,
                    'event_id' => $selection['event_id'],
                    'bet_type' => $selection['bet_type'],
                    'selection' => $selection['selection'],
                    'odds' => $selection['odds'],
                ]);
            }

            // Descontar saldo
            $user->balance -= $validated['amount'];
            $user->save();

            // Notificar al usuario
            $user->notifications()->create([
                'message' => "Parlay creado exitosamente. Ganancia potencial: PEN " . number_format($potentialWin, 2),
                'type' => 'parlay_created',
            ]);
        });

        return redirect()->route('parlays.index')
            ->with('success', 'Parlay creado exitosamente');
    }

    public function show(Parlay $parlay)
    {
        if ($parlay->user_id !== Auth::id()) {
            abort(403);
        }

        $parlay->load(['selections.event']);

        return view('parlays.show', compact('parlay'));
    }

    public function cancel(Parlay $parlay)
    {
        if ($parlay->user_id !== Auth::id() || $parlay->status !== 'pending') {
            return back()->withErrors(['error' => 'No puedes cancelar este parlay']);
        }

        // Verificar que ningún evento haya comenzado
        $hasStarted = $parlay->selections()
            ->whereHas('event', function ($query) {
                $query->where('start_time', '<=', now());
            })
            ->exists();

        if ($hasStarted) {
            return back()->withErrors(['error' => 'No puedes cancelar un parlay con eventos en curso']);
        }

        DB::transaction(function () use ($parlay) {
            // Devolver saldo
            $user = Auth::user();
            $user->balance += $parlay->amount;
            $user->save();

            // Cancelar parlay
            $parlay->update(['status' => 'cancelled']);

            // Notificar al usuario
            $user->notifications()->create([
                'message' => "Parlay cancelado. Se devolvió PEN " . number_format($parlay->amount, 2),
                'type' => 'parlay_cancelled',
            ]);
        });

        return back()->with('success', 'Parlay cancelado exitosamente');
    }
}
