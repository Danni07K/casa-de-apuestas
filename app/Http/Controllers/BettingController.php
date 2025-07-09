<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Event;

class BettingController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the bets.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Event::query()->where('status', 'scheduled')->where('start_time', '>', now());

        if ($request->has('league')) {
            $query->where('league', $request->league);
        }

        $events = $query->get();

        $recentBets = null;
        if (auth()->check()) {
            $recentBets = \App\Models\Bet::with('event')
                ->where('user_id', auth()->id())
                ->orderByDesc('created_at')
                ->take(5)
                ->get();
        }

        return view('betting.index', compact('events', 'recentBets'));
    }

    /**
     * Show the form for creating a new bet.
     */
    public function create()
    {
        $events = \App\Models\Event::where('status', 'scheduled')
            ->where('start_time', '>', now())
            ->get();

        return view('betting.create', compact('events'));
    }

    /**
     * Store a newly created bet in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $event = \App\Models\Event::findOrFail($validated['event_id']);

        // Verificar que el evento aún no ha comenzado
        if ($event->start_time <= now()) {
            return back()->withErrors(['event_id' => 'Este evento ya ha comenzado.']);
        }

        $bet = new \App\Models\Bet($validated);
        $bet->user_id = \Auth::id();
        $bet->save();

        return redirect()->route('betting.index')
            ->with('success', 'Apuesta creada exitosamente.');
    }

    /**
     * Display the specified bet.
     */
    public function show(Bet $betting)
    {
        $this->authorize('view', $betting);
        return view('betting.show', compact('betting'));
    }

    /**
     * Show the form for editing the specified bet.
     */
    public function edit(\App\Models\Bet $betting)
    {
        $this->authorize('update', $betting);
        if ($betting->event->start_time <= now()) {
            return redirect()->route('betting.index')
                ->withErrors(['error' => 'No se puede editar una apuesta después de que el evento ha comenzado.']);
        }
        $events = \App\Models\Event::where('status', 'scheduled')
            ->where('start_time', '>', now())
            ->get();
        return view('betting.edit', compact('betting', 'events'));
    }

    /**
     * Update the specified bet in storage.
     */
    public function update(Request $request, \App\Models\Bet $betting)
    {
        $this->authorize('update', $betting);
        if ($betting->event->start_time <= now()) {
            return redirect()->route('betting.index')
                ->withErrors(['error' => 'No se puede actualizar una apuesta después de que el evento ha comenzado.']);
        }
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric|min:1',
        ]);
        $event = \App\Models\Event::findOrFail($validated['event_id']);
        if ($event->start_time <= now()) {
            return back()->withErrors(['event_id' => 'Este evento ya ha comenzado.']);
        }
        $betting->update($validated);
        return redirect()->route('betting.index')
            ->with('success', 'Apuesta actualizada exitosamente.');
    }

    /**
     * Remove the specified bet from storage.
     */
    public function destroy(\App\Models\Bet $betting)
    {
        $this->authorize('delete', $betting);
        if ($betting->event->start_time <= now()) {
            return redirect()->route('betting.index')
                ->withErrors(['error' => 'No se puede eliminar una apuesta después de que el evento ha comenzado.']);
        }
        $betting->delete();
        return redirect()->route('betting.index')
            ->with('success', 'Apuesta eliminada exitosamente.');
    }

    public function bet(Event $event)
    {
        $recentBets = \App\Models\Bet::with('event')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('betting.bet', compact('event', 'recentBets'));
    }

    public function placeBet(Request $request, Event $event)
    {
        $validated = $request->validate([
            'bet_type' => 'required|in:1x2,primer_gol,ambos_marcan',
            'selection' => 'required|string',
            'odds' => 'required|numeric',
            'amount' => 'required|numeric|min:1',
        ]);
        $user = auth()->user();
        if ($user->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'No tienes saldo suficiente para realizar esta apuesta.'])->withInput();
        }
        $bet = new \App\Models\Bet($validated);
        $bet->user_id = $user->id;
        $bet->event_id = $event->id;
        $bet->status = 'pending';
        $bet->save();
        // Descontar saldo
        $user->balance -= $validated['amount'];
        $user->save();
        return redirect()->route('betting.bet', $event->id)->with('success', '¡Apuesta realizada con éxito!');
    }

    public function cancel(Bet $bet)
    {
        $user = auth()->user();
        if ($bet->user_id !== $user->id || $bet->status !== 'pending') {
            return back()->withErrors(['error' => 'No puedes cancelar esta apuesta.']);
        }
        if ($bet->event->status === 'live') {
            return back()->withErrors(['error' => 'No puedes cancelar una apuesta cuando el evento está en vivo. Solo puedes hacer cashout.']);
        }
        $user->balance += $bet->amount;
        $user->save();
        $bet->status = 'cancelled';
        $bet->save();
        return back()->with('success', 'Apuesta cancelada y saldo devuelto.');
    }

    public function cashout(Bet $bet)
    {
        $user = auth()->user();
        if ($bet->user_id !== $user->id || $bet->status !== 'pending') {
            return back()->withErrors(['error' => 'No puedes hacer cashout de esta apuesta.']);
        }
        $cashoutAmount = $bet->amount * 0.9;
        $user->balance += $cashoutAmount;
        $user->save();
        $bet->status = 'cashed_out';
        $bet->save();
        return back()->with('success', 'Cashout realizado. Se devolvió el 90% del monto apostado.');
    }

    public function history(Request $request)
    {
        $user = auth()->user();
        $from = $request->input('from');
        $to = $request->input('to');
        $query = $user->bets()->with('event');
        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }
        $openBets = (clone $query)->whereIn('status', ['pending', 'cashed_out'])->latest()->get();
        $resolvedBets = (clone $query)->whereIn('status', ['won', 'lost', 'cancelled'])->latest()->get();
        return view('betting.history', compact('openBets', 'resolvedBets', 'from', 'to'));
    }

    // Método para mostrar notificaciones (puede usarse en el header o en la vista principal)
    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->take(10)->get();
        return response()->json($notifications);
    }

    // Marcar todas las notificaciones como leídas
    public function markNotificationsAsRead()
    {
        $user = auth()->user();
        $user->notifications()->where('is_read', false)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
