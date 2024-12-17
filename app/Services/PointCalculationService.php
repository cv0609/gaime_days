<?php
namespace App\Services;

use App\Models\PlayerStatistic;
use App\Models\Team;
use App\Models\TeamDetail;

class PointCalculationService
{
    protected $points = [
        'goal' => 8,
        'assist' => 6,
        'yellow_card' => -1,
        'red_card' => -3,
        'save' => 2,
        'clean_sheet' => 4,
        'penalty_save' => 8,
        'penalty_missed' => -2,
        'minutes_played' => 1,
    ];

    public function calculatePoints($userId, $matchId)
    {
        $userTeam = Team::whereHas('teamDetails', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('teamDetails')->get();

        $totalPoints = 0;

        foreach ($userTeam as $teamPlayer) {

            foreach($teamPlayer->teamDetails as $details){

                $statistics = PlayerStatistic::where('player_id', $details->player_id)
                                             ->where('match_id', $matchId)
                                             ->first();
                if ($statistics) {

                    $points = $this->calculatePlayerPoints($statistics);
                    if ($details->is_captain) {
                        $points *= 2;
                    } elseif ($details->is_vice_captain) {
                        $points *= 1.5;
                    }
                    $totalPoints += $points;
                }
            }
        }
        return $totalPoints;
    }


    public function getPlayerStatistics($userId, $matchId, $player_id)
    {
        $statistics = PlayerStatistic::where('player_id', $player_id)->where('match_id', $matchId)->first();

        if (!$statistics) {
            return 0; 
        }
        
        $teamPlayer = TeamDetail::whereHas('teams', function ($query) use ($userId, $matchId) {
            $query->where('user_id', $userId)
                  ->where('match_id', $matchId);
        })
        ->where('player_id', $player_id)
        ->first();


        $points = $this->calculatePlayerPoints($statistics);

        if ($teamPlayer) {
            if ($teamPlayer->is_captain) {
                $points *= 2;
            } elseif ($teamPlayer->is_vice_captain) {
                $points *= 1.5;
            }
        }

        return $points; // Return the calculated points
    }


    protected function calculatePlayerPoints($statistics)
    {
        $points = 0;

        $points += $statistics->goals * $this->points['goal'];
        $points += $statistics->assists * $this->points['assist'];
        $points += $statistics->yellow_cards * $this->points['yellow_card'];
        $points += $statistics->red_cards * $this->points['red_card'];
        $points += $statistics->saves * $this->points['save'];
        $points += $statistics->minutes_played >= 60 ? $this->points['minutes_played'] : 0;

        return $points;
    }
}
