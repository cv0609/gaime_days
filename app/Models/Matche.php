<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{
    use HasFactory;
    protected $fillable = [
        'league_id',
        'fixture_id',
        'venue_name',
        'venue_city',
        'long_status',
        'short_status',
        'home_team_id',
        'home_team_name',
        'home_team_logo',
        'away_team_id',
        'away_team_name',
        'away_team_logo',
        'fixture_date',
    ];

    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public static function getMatchByLeagueId($leagueId)
    {
        // Return matches where the league_id matches the input and the match has players
        return self::with('league')
            ->where('league_id', $leagueId)
            ->whereHas('matchPlayers') 
            ->orderBy('fixture_date','asc')
            ->get(); 
    }
    
    public function matchPlayers()
    {
        return $this->hasMany(Player::class, 'match_id');
    }

}
