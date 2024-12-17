<?php

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Services\ApiFootballService;
use App\Models\PlayerStatistic;
use Carbon\CarbonTimeZone;


function LeagueTeamPlayerValidation($team_id, $player_id, $player_role, $leagueId, $player_name)
{
    $roleLimits = [
        'G' => 1,  // Goalkeeper count
        'D' => ['min' => 3, 'max' => 5],  // Defender count
        'M' => ['min' => 3, 'max' => 5],  // Midfielder count
        'F' => ['min' => 1, 'max' => 3]   // Striker count
    ];

    if (!isset($team_id, $player_id, $player_role, $leagueId, $player_name)) {
        return ['success' => false, 'message' => 'Cannot add player.'];
    }

    $myTeam = Session::get('myTeam', []);

    $roleCounts = [
        'G' => 0, // Goalkeeper
        'D' => 0, // Defender
        'M' => 0, // Midfielder
        'F' => 0  // Striker
    ];

    foreach ($myTeam as $player) {
        if (isset($player['player_role'])) {
            $roleCounts[$player['player_role']]++;
        }
    }

    $totalPlayers = array_sum($roleCounts);

    // Check if adding this player would exceed 11 players
    if ($totalPlayers > 11) {
        return ['success' => false, 'message' => 'Team cannot exceed 11 players.'];
    }

    $response = ['success' => true, 'message' => 'Player added successfully'];

    switch ($player_role) {
        case 'G':
            if ($roleCounts['G'] >= $roleLimits['G']) {
                $response = ['success' => false, 'message' => 'You can add only one goalkeeper.'];
            }
            break;

        case 'D':
            if ($roleCounts['D'] >= $roleLimits['D']['max']) {
                $response = ['success' => false, 'message' => 'You can add only between ' . $roleLimits['D']['min'] . ' and ' . $roleLimits['D']['max'] . ' defenders.'];
            }
            break;

        case 'M':
            if ($roleCounts['M'] >= $roleLimits['M']['max']) {
                $response = ['success' => false, 'message' => 'You can add only between ' . $roleLimits['M']['min'] . ' and ' . $roleLimits['M']['max'] . ' midfielders.'];
            }
            break;

        case 'F':
            if ($roleCounts['F'] >= $roleLimits['F']['max']) {
                $response = ['success' => false, 'message' => 'You can add only between ' . $roleLimits['F']['min'] . ' and ' . $roleLimits['F']['max'] . ' strikers.'];
            }
            break;

        default:
            $response = ['success' => false, 'message' => 'Invalid player role.'];
    }

    $totalPlayers = array_sum($roleCounts) + 1;
    if ($totalPlayers > 11) {
        $response = ['success' => false, 'message' => 'Total players must be exactly 11.'];
    }

    return $response;
}

function getMatchStatus($date)
{
    $startTime = Carbon::now();  // Keep this as a Carbon object
    $endTime = Carbon::parse($date);  //$date is utc timezone
    $minutesDifference = $startTime->diffInMinutes($endTime);
    return $minutesDifference; // Outputs the difference in minutes
}

// function checkMatch($leagueId)
//  {
//     $res = false;
//     $apiFootballService = app(ApiFootballService::class);
//     $matches =$apiFootballService->get('/fixtures', [
//         'league' => $leagueId,
//         'from' => Carbon::now()->format('Y-m-d'),
//         'to' => Carbon::now()->addYear(100)->format('Y-m-d'),
//         'season' =>  Carbon::now()->format('Y')
//     ]);

//     if(!empty($matches['response']))
//     {
//         $res = true;
//     }
//     return $res;
//  }
?>
