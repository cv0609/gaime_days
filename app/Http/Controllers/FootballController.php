<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Matche;
use App\Models\Player;
use App\Services\ApiFootballService;
use App\Services\PointCalculationService;
use Illuminate\Http\Request;
// use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Js;
use App\Models\Team;
use App\Models\TeamDetail;
use App\Models\TeamTeamDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Traits\PaginationTrait;

class FootballController extends Controller
{
    protected $apiFootballService;
    protected $pointCalculationService;
    use PaginationTrait;

    public function __construct(ApiFootballService $apiFootballService,PointCalculationService $pointCalculationService)
    {
        $this->apiFootballService = $apiFootballService;
        $this->pointCalculationService = $pointCalculationService;
    }

    public function getLeague()
    {
        $leagues = League::whereHas('leagueMatches', function ($query) {
          $query->whereHas('matchPlayers');
        })->orderBy('start_date','desc')->get();

        return view('front_end.pages.football.premier_league', compact('leagues'));
    }

    public function getLeagueMatches($leagueId)
     {
        $matches = Matche::getMatchByLeagueId($leagueId);
   
        if(isset($matches) && !empty($matches))
         {
            return view('front_end.pages.football.matches',compact('matches'));
         }
         else
         {
            return redirect()->back()->with('error','No matches found in this league.');
         }
     }

    public function matchDetails($matcheId)
      {
        
        $matchDetails = Matche::with(['matchPlayers','league'])->where('id',$matcheId)->get();    

        $organizedPlayers = [
            'Attacker' => [],
            'Defender' => [],
            'Midfielder' => [],
            'Goalkeeper' => []
        ];

        if(isset($matchDetails[0]->matchPlayers) && !empty($matchDetails[0]->matchPlayers)){

            foreach($matchDetails[0]->matchPlayers as $player){
    
                if (isset($organizedPlayers[$player->position])) {
                    
                    $organizedPlayers[$player->position][] = $player;
                }
            }
        }
        return view('front_end.pages.football.premier_league_players',compact('matchDetails','organizedPlayers','matcheId'));
      }

    public function getLeagueTeams($leagueId,$season)
    {
        $response = $this->apiFootballService->get('/teams', [
            'league' => $leagueId,
            'season' => $season,
        ]);

        return view('premier_league', ['leagues' => $response]);
    }

    public function createTeam(Request $request){

        $team_id = $request->team_id;
        $player_id = $request->player_id;
        $player_role = $request->player_role;
        $leagueId = $request->leagueId;
        $player_name = $request->player_name;
        $team_logo = $request->team_logo;
        $match_id = $request->match_id;
        $team_name = $request->team_name;
        $homeTeamId = $request->homeTeamId;
        $awayTeamId = $request->awayTeamId;
        $dbMatchId = $request->dbMatchId;

        if(isset($request->event) && $request->event == "plus")
          {
            $validationMsg = LeagueTeamPlayerValidation($team_id, $player_id, $player_role,$leagueId,$player_name);

            if(isset($validationMsg) && $validationMsg['success'] == true){

                $myTeam = Session::get('myTeam', []);

                $myTeam[] = [
                    'league_id' => $leagueId,
                    'match_id' => $match_id,
                    'team_id' => $team_id,
                    'player_id' => $player_id,
                    'player_name' => $player_name,
                    'player_role' => $player_role,
                    'team_logo' => $team_logo,
                    'team_name' => $team_name,
                    'is_captain' => '0',
                    'is_vice_captain' => '0',
                    'homeTeamId' => $homeTeamId,
                    'awayTeamId' => $awayTeamId,
                    'dbMatchId' => $dbMatchId,
                ];

                Session::put('myTeam', $myTeam);
            }
            return response()->json($validationMsg);
          }
        elseif(isset($request->event) && $request->event == "minus")
         {
            $myTeam = Session::get('myTeam', []);

            $playerExists = false;

            foreach ($myTeam as $player) {
                if ($player['team_id'] == $team_id &&
                    $player['player_id'] == $player_id &&
                    $player['player_role'] == $player_role &&
                    $player['league_id'] == $leagueId &&
                    $player['player_name'] == $player_name) {
                    $playerExists = true;
                    break;
                }
            }

            if (!$playerExists) {
               $response = ['success' => false, 'message' => 'Player not found in the team.'];
            }

            $myTeam = array_filter($myTeam, function($player) use ($team_id, $player_id, $player_role, $leagueId, $player_name) {
                return !(
                    $player['team_id'] == $team_id &&
                    $player['player_id'] == $player_id &&
                    $player['player_role'] == $player_role &&
                    $player['league_id'] == $leagueId &&
                    $player['player_name'] == $player_name
                );
            });

            $myTeam = array_values($myTeam);

            Session::put('myTeam', $myTeam);

            $response = ['success' => true, 'message' => 'Player removed successfully'];

            return response()->json($response);
         }

    }

    public function viewTeam(){
        $myTeam = [];
        if(Session::has('myTeam')){
            $myTeam = Session::get('myTeam', []);
        }

        return view('front_end.pages.football.team-view',compact('myTeam'));
    }

    public function currentTeamCount(){
        $count = $this->apiFootballService->getCurrentTeamCount();
        $response = ['success' => true, 'count' => $count];
        return response()->json($response);
    }

    public function AuthCheck(){
        $authCheck = false;
        $myTeam = Session::get('myTeam', []);

        $captainMissing = false;
        $viceCaptainMissing = false;

        if (Session::has('myTeam')) {
            $myTeam = Session::get('myTeam');

            foreach ($myTeam as $item) {
                if ($item['is_captain'] == '1') {
                    $captainMissing = true;
                }

                if ($item['is_vice_captain'] == '1') {
                    $viceCaptainMissing = true;
                }
            }
        }

        if(Auth::check()){
            $authCheck = true;
        }

        return response()->json([
            'captain' => $captainMissing,
            'vice_captain' => $viceCaptainMissing,
            'error' => $authCheck,
            'myTeam' => $myTeam
        ]);
    }


    public function saveTeam(){

        if(Session::has('myTeam')){
            $myTeam = Session::get('myTeam', []);

            $count = count($myTeam);

            if ($count > 0) {

                $league_id = $myTeam[0]['league_id'];
                $match_id = $myTeam[0]['match_id'];

                $team_number = Team::generateTeamNumber();

                $teamData = Team::create(['team_number' => $team_number,'league_id' =>$league_id,'match_id' =>$match_id]);

                if(isset($teamData)){
                    foreach($myTeam as $team){

                        $is_captain = '0';
                        $is_vice_captain = '0';

                        if($team['is_captain'] == '1'){
                            $is_captain = '1';
                        }

                        if($team['is_vice_captain'] == '1'){
                            $is_vice_captain = '1';
                        }

                        $teamDetail = TeamDetail::create(['player_id' => $team['player_id'],'player_team_id' => $team['team_id'],'player_pos' =>$team['player_role'],'player_name' =>$team['player_name'],'player_team_name' => $team['team_name'],'player_team_logo' =>$team['team_logo'],'is_captain' => $is_captain,'is_vice_captain' => $is_vice_captain]);

                        $teamData->teamDetails()->attach($teamDetail->id,['user_id' => Auth::user()->id]);
                    }
                }

                Session::forget(['myTeam']);

                return redirect()->route('leagues')->with('success','Team added successfully.');
            }
        }else{
            return redirect()->back()->with('error','Some thing went wrong');
        }
    }

    public function makeCaptain(Request $request)
    {
        $event = $request->input('event');
        $credentials = $request->only(['league_id', 'match_id', 'team_id', 'player_id']);

        $myTeam = Session::get('myTeam', []);
        $updated = false;

        $captainExists = false;
        $viceCaptainExists = false;

        // Check if any player is already a captain or vice-captain
        foreach ($myTeam as $player) {
            if ($player['is_captain'] == '1') {
                $captainExists = true;
            }

            if ($player['is_vice_captain'] == '1') {
                $viceCaptainExists = true;
            }
        }

        foreach ($myTeam as &$player) {
            if (
                $player['league_id'] == $credentials['league_id'] &&
                $player['match_id'] == $credentials['match_id'] &&
                $player['team_id'] == $credentials['team_id'] &&
                $player['player_id'] == $credentials['player_id']
            ) {
                if ($event == 'cap_plus') {
                    if (!$captainExists && $player['is_captain'] == '0') {
                        $player['is_captain'] = '1';
                        $player['already_captain'] = true;
                        $captainExists = true;
                    }
                } elseif ($event == 'cap_minus') {
                    if ($player['is_captain'] == '1') {
                        $player['is_captain'] = '0';
                        unset($player['already_captain']);
                        $captainExists = false;
                    }
                } elseif ($event == 'vice_plus') {
                    if (!$viceCaptainExists && $player['is_vice_captain'] == '0') {
                        $player['is_vice_captain'] = '1';
                        $player['already_vice_captain'] = true;
                        $viceCaptainExists = true;
                    }
                } elseif ($event == 'vice_minus') {
                    if ($player['is_vice_captain'] == '1') {
                        $player['is_vice_captain'] = '0';
                        unset($player['already_vice_captain']);
                        $viceCaptainExists = false;
                    }
                }
                $updated = true;
                break;
            }
        }

        if ($updated) {
            Session::put('myTeam', $myTeam);
        }
        return response()->json(['session' => $myTeam]);
    }
}
