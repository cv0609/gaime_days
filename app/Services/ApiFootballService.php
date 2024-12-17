<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\League;
use App\Models\Matche;
use App\Models\Player;

class ApiFootballService
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('API_FOOTBALL_BASE_URL');
        $this->apiKey = env('API_FOOTBALL_API_KEY');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 5.0,
        ]);
    }

    public function get($endpoint, $params = [],$type = "GET")
    {
        try {
            $response = $this->client->request($type, $endpoint, [
                'query' => $params,
                'verify' => false,
                'headers' => [
                    'x-rapidapi-host' => 'api-football-v1.p.rapidapi.com',
                    'x-rapidapi-key' => $this->apiKey,

                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (RequestException $e) {

            if ($e->hasResponse()) {
                return json_decode($e->getResponse()->getBody()->getContents(), true);
            }

            return ['error' => 'Request failed'];
        }
    }

    public function getCurrentTeamCount()
    {
        $count = 0;
        if(Session::has('myTeam') && is_array(Session::get('myTeam')))
        {
            $team_data = Session::get('myTeam');
            $count = count($team_data);
        }
        return $count ;
    }

    public function getLiveMatches(){
        $matches = $this->get('/fixtures', [
            'live' => 'all',
            'season' => date("Y"),
            //  'last' => 5
        ]);
        return $matches;
     }

     public function getPlayerStatics($matchId){
        $matches = $this->get('/fixtures/players', [
            'fixture' => $matchId,
        ]);
        
        return $matches;
     }


     public function getLeagues()
     {
         $leagues = $this->get('/leagues', [
             'season' => date("Y"),
             // 'last' => 5
         ]);
        
         return $leagues;
     }

    public function addFootballData($leagues)
    {
        foreach ($leagues as $league) {
            $league_res = League::updateOrCreate(
                [
                    'league_id' => $league['league']['id'],
                ],
                [
                    'name' => $league['league']['name'],
                    'type' => $league['league']['type'],
                    'logo' => $league['league']['logo'],
                    'country_name' => $league['country']['name'],
                    'country_code' => $league['country']['code'],
                    'country_flag' => $league['country']['flag'],
                    'year' => $league['seasons'][0]['year'],
                    'start_date' => $league['seasons'][0]['start'],
                    'end_date' => $league['seasons'][0]['end'],
                ]
            );
    
            if ($league_res) {
                $this->processLeagueMatches($league_res);
            }
        }
    }
    
    private function processLeagueMatches($league)
    {
        $matches = $this->getMatches($league);
    
        if (!empty($matches['response'])) {
            $this->addMatch($matches['response'], $league->id);
        }
    }
    
    private function getMatches($league)
    {
        return $this->get('/fixtures', [
            'league' => $league->league_id,
            'from' => Carbon::now()->format('Y-m-d'),
            'to' => Carbon::now()->addYear(100)->format('Y-m-d'),
            'season' => Carbon::now()->format('Y'),
        ]);
    }
    
    private function addMatch($matches, $league_id)
    {
        foreach ($matches as $match) {
            $match_res = Matche::updateOrCreate(
                [
                    'league_id' => $league_id,
                    'fixture_id' => $match['fixture']['id'],
                ],
                [
                    'venue_name' => $match['fixture']['venue']['name'],
                    'venue_city' => $match['fixture']['venue']['city'],
                    'long_status' => $match['fixture']['status']['long'],
                    'short_status' => $match['fixture']['status']['short'],
                    'home_team_id' => $match['teams']['home']['id'],
                    'home_team_name' => $match['teams']['home']['name'],
                    'home_team_logo' => $match['teams']['home']['logo'],
                    'away_team_id' => $match['teams']['away']['id'],
                    'away_team_name' => $match['teams']['away']['name'],
                    'away_team_logo' => $match['teams']['away']['logo'],
                    'fixture_date' => $match['fixture']['date'],
                ]
            );
    
            if ($match_res) {
                $this->addPlayers($match_res);
            }
        }
    }
    
    private function addPlayers($match_res)
    {
        $teamIds = [$match_res->home_team_id, $match_res->away_team_id];
    
        foreach ($teamIds as $teamId) {
            $playerDetails = $this->getPlayers($teamId);
    
            if (!empty($playerDetails['response'])) {
                $this->savePlayers($playerDetails['response'], $match_res->id);
            }
        }
    }
    
    private function getPlayers($teamId)
    {
        return $this->get('players', [
            'team' => $teamId,
            'season' => Carbon::now()->format('Y'),
        ]);
    }
    
    private function savePlayers($players, $matchId)
    {
        foreach ($players as $player) {
            Player::updateOrCreate(
                [
                    'match_id' => $matchId,
                    'player_id' => $player['player']['id'],
                ],
                [
                    'player_team_id' => $player['statistics'][0]['team']['id'],
                    'name' => $player['player']['name'],
                    'age' => $player['player']['age'],
                    'position' => $player['statistics'][0]['games']['position'],
                    'injured' => $player['player']['injured'] == true ? '1' : '0',
                    'team_logo' => $player['statistics'][0]['team']['logo'],
                ]
            );
        }
    }
}
