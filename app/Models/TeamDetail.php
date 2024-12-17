<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'player_team_id',
        'player_pos',
        'player_name',
        'player_team_name',
        'player_team_logo',
        'is_captain',
        'is_vice_captain'
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_team_details', 'team_detail_id', 'team_id')->withPivot('user_id')->withTimestamps();
    }
}
