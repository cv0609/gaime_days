<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStatistic extends Model
{

    protected $fillable = [
        'match_id',
        'player_id',
        'goals',
        'assists',
        'yellow_cards',
        'red_cards',
        'saves',
        'minutes_played',
        'minutes_played',
    ];

    use HasFactory;
}
