<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = "palyers";
    protected $fillable = [
        'match_id',
        'player_id',
        'player_team_id',
        'name',
        'age',
        'position',
        'injured',
        'team_logo',
    ];

    use HasFactory;
}
