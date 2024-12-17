<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTeamDetail extends Model
{
    use HasFactory;

    protected $table = 'team_team_details';

    protected $fillable = [
        'team_id',
        'team_detail_id',
        'user_id'
    ];
}
