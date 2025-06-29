<?php

namespace App\Policies;

use App\Models\Bet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BetPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bet $bet): bool
    {
        return $user->id === $bet->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bet $bet): bool
    {
        return $user->id === $bet->user_id && $bet->game->start_time > now();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bet $bet): bool
    {
        return $user->id === $bet->user_id && $bet->game->start_time > now();
    }
} 