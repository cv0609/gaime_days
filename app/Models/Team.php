<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_number',
        'league_id',
        'match_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teamDetails()
    {
        return $this->belongsToMany(TeamDetail::class, 'team_team_details', 'team_id', 'team_detail_id')->withPivot('user_id')
        ->wherePivot('user_id', Auth::id())->withTimestamps();
    }


    public static function generateTeamNumber()
    {
        do {
            $teamNumber = 'TM-' . strtoupper(Str::random(10));
        } while (self::where('team_number', $teamNumber)->exists());

        return $teamNumber;
    }

}
