<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
        'min_amount',
        'max_amount',
        'instructions',
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
} 