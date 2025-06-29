<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Búsqueda por nombre de equipo
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('home_team', 'like', "%{$searchTerm}%")
                  ->orWhere('away_team', 'like', "%{$searchTerm}%");
            });
        }

        // Filtro por estado
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $events = $query->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(10)
            ->withQueryString(); // Añade los parámetros de la URL a los enlaces de paginación

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'league' => 'required|string|max:255',
            'status' => 'required|in:scheduled,live,finished,cancelled',
            'date' => 'required|date',
            'start_time' => 'required',
            'home_odds' => 'required|numeric|min:1',
            'draw_odds' => 'required|numeric|min:1',
            'away_odds' => 'required|numeric|min:1',
        ]);

        // Combinar fecha y hora
        $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
        $validated['start_time'] = $startTime;

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Evento deportivo creado correctamente.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'league' => 'required|string|max:255',
            'status' => 'required|in:scheduled,live,finished,cancelled',
            'date' => 'required|date',
            'start_time' => 'required',
            'home_odds' => 'required|numeric|min:1',
            'draw_odds' => 'required|numeric|min:1',
            'away_odds' => 'required|numeric|min:1',
            'result' => 'nullable|string',
        ]);

        // Combinar fecha y hora
        $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
        $validated['start_time'] = $startTime;

        $event->update([
            'home_team' => $validated['home_team'],
            'away_team' => $validated['away_team'],
            'league' => $validated['league'],
            'status' => $validated['status'],
            'date' => $validated['date'],
            'start_time' => $startTime,
            'home_odds' => $validated['home_odds'],
            'draw_odds' => $validated['draw_odds'],
            'away_odds' => $validated['away_odds'],
            'result' => $request->input('result_1x2') ?: null,
            'first_goal' => $request->input('result_primer_gol') ? str_replace('primer_gol:', '', $request->input('result_primer_gol')) : null,
            'both_score' => $request->input('result_ambos_marcan') ? str_replace('ambos_marcan:', '', $request->input('result_ambos_marcan')) : null,
        ]);

        // Procesar apuestas solo si el evento se finaliza
        if ($validated['status'] === 'finished') {
            $result = $request->input('result_1x2');
            $first_goal = $request->input('result_primer_gol') ? str_replace('primer_gol:', '', $request->input('result_primer_gol')) : null;
            $both_score = $request->input('result_ambos_marcan') ? str_replace('ambos_marcan:', '', $request->input('result_ambos_marcan')) : null;
            $bets = $event->bets()->where('status', 'pending')->get();
            foreach ($bets as $bet) {
                $won = false;
                if ($bet->bet_type === '1x2' && $result) {
                    if (
                        ($result === 'local' && $bet->selection === $event->home_team) ||
                        ($result === 'empate' && strtoupper($bet->selection) === 'EMPATE') ||
                        ($result === 'visitante' && $bet->selection === $event->away_team)
                    ) {
                        $won = true;
                    }
                }
                if ($bet->bet_type === 'primer_gol' && $first_goal) {
                    if ($first_goal === $bet->selection) {
                        $won = true;
                    }
                }
                if ($bet->bet_type === 'ambos_marcan' && $both_score) {
                    if (strtoupper($both_score) === strtoupper($bet->selection)) {
                        $won = true;
                    }
                }
                if ($won) {
                    $bet->status = 'won';
                    $bet->user->balance += $bet->amount * $bet->odds;
                    $bet->user->save();
                    \App\Models\Notification::create([
                        'user_id' => $bet->user_id,
                        'message' => '¡Felicidades! Ganaste la apuesta en ' . $event->home_team . ' vs ' . $event->away_team . ' y recibiste PEN ' . number_format($bet->amount * $bet->odds, 2),
                        'type' => 'success',
                    ]);
                } else {
                    $bet->status = 'lost';
                }
                $bet->save();
            }
        }

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Evento deportivo actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Evento deportivo eliminado correctamente.');
    }
} 