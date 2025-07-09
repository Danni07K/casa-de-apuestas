<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Announcement whereUpdatedAt($value)
 */
	class Announcement extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property string $bet_type
 * @property string $selection
 * @property string $odds
 * @property numeric $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereBetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereSelection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bet whereUserId($value)
 */
	class Bet extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property int $min_selections
 * @property int $max_selections
 * @property string $min_stake
 * @property string $max_stake
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bet> $bets
 * @property-read int|null $bets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereMaxSelections($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereMaxStake($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereMinSelections($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereMinStake($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BetType whereUpdatedAt($value)
 */
	class BetType extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property numeric|null $amount
 * @property numeric|null $percentage
 * @property int|null $min_deposit
 * @property numeric|null $max_bonus
 * @property int|null $wagering_requirement
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property bool $is_active
 * @property array<array-key, mixed>|null $conditions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserBonus> $userBonuses
 * @property-read int|null $user_bonuses_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereMaxBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereMinDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereWageringRequirement($value)
 * @mixin \Eloquent
 */
	class Bonus extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $payment_method_id
 * @property numeric $amount
 * @property string $status
 * @property string|null $reference_number
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $processed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PaymentMethod $paymentMethod
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deposit whereUserId($value)
 */
	class Deposit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $home_team
 * @property string $away_team
 * @property string $league
 * @property string $status
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon $start_time
 * @property string $home_odds
 * @property string $draw_odds
 * @property string $away_odds
 * @property string|null $result
 * @property string|null $first_goal
 * @property string|null $both_score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bet> $bets
 * @property-read int|null $bets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereAwayOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereAwayTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereBothScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDrawOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereFirstGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereHomeOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereHomeTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereLeague($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $home_team
 * @property string $away_team
 * @property \Illuminate\Support\Carbon $start_time
 * @property string $status
 * @property string|null $result
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bet> $bets
 * @property-read int|null $bets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereAwayTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereHomeTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Game whereUpdatedAt($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property string $type
 * @property int $read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUserId($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property numeric $total_odds
 * @property numeric $amount
 * @property numeric $potential_win
 * @property string $status
 * @property int $total_selections
 * @property int $won_selections
 * @property numeric|null $partial_win_amount
 * @property \Illuminate\Support\Carbon|null $settled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ParlaySelection> $selections
 * @property-read int|null $selections_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay wherePartialWinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay wherePotentialWin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereSettledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereTotalOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereTotalSelections($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereWonSelections($value)
 * @mixin \Eloquent
 */
	class Parlay extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $parlay_id
 * @property int $event_id
 * @property string $bet_type
 * @property string $selection
 * @property numeric $odds
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Parlay $parlay
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereBetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereParlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereSelection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ParlaySelection extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $status
 * @property string $min_amount
 * @property string $max_amount
 * @property string $instructions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deposit> $deposits
 * @property-read int|null $deposits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereMaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereUpdatedAt($value)
 */
	class PaymentMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon $birthdate
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string $balance
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bet> $bets
 * @property-read int|null $bets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deposit> $deposits
 * @property-read int|null $deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $bonus_id
 * @property numeric $amount
 * @property numeric $wagered_amount
 * @property string $status
 * @property \Illuminate\Support\Carbon $activated_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bonus $bonus
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereBonusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereWageredAmount($value)
 * @mixin \Eloquent
 */
	class UserBonus extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $level
 * @property int $experience_points
 * @property int $total_points_earned
 * @property \Illuminate\Support\Carbon|null $last_level_up
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereExperiencePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereLastLevelUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereTotalPointsEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereUserId($value)
 * @mixin \Eloquent
 */
	class UserLevel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $vip_level_id
 * @property numeric $total_deposits
 * @property numeric $total_wagered
 * @property \Illuminate\Support\Carbon|null $level_up_at
 * @property \Illuminate\Support\Carbon|null $last_activity_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\VipLevel $vipLevel
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereLastActivityAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereLevelUpAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereTotalDeposits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereTotalWagered($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereVipLevelId($value)
 * @mixin \Eloquent
 */
	class UserVip extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $level
 * @property numeric $min_deposits
 * @property numeric $cashback_percentage
 * @property numeric $bonus_percentage
 * @property int $free_bets_monthly
 * @property bool $priority_support
 * @property bool $exclusive_events
 * @property string $badge_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserVip> $userVips
 * @property-read int|null $user_vips_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereBadgeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereBonusPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereCashbackPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereExclusiveEvents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereFreeBetsMonthly($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereMinDeposits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel wherePrioritySupport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class VipLevel extends \Eloquent {}
}

