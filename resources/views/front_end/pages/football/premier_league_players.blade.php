 @extends('front_end.layout.main')
 @section('content')

 <!--Leagues Pages Banner Section Start -->
 <section class="pages-banner leagues-pages  bg-cover bg-no-repeat">
     <div class="container">
         <div class="banner-content">
             <ul class="leagues-ul">
                 <li class="inline-list home-list">
                     <h3>
                         <a href="{{ route('home') }}">Homepage</a>
                     </h3>
                 </li>
                 <li class="inline-list next-page-list">
                     <h3>
                         Matches Details
                     </h3>
                 </li>
             </ul>
         </div>
     </div>
 </section>
 <!--Leagues Pages Banner Section End -->

 <!-- Leagues Content Section Start -->
 <section class="american_leagues matches-details">
     <div class="container">


         <div class="american_leagues-inner">
             <div class="back-btn">
                 <a href="{{ route('leagueMatches',['leagueId'=>$matchDetails[0]->league->id]) }}">
                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                         fill="#000">
                         <path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"></path>
                     </svg>
                 </a>
             </div>
             <h2>{{ $matchDetails[0]->league->year ?? ''}} Season</h2>

             <div class="plyr-hedr">
                 <div class="team-logo">
                     <div class="team_inner">
                         <!-- <div class="match-details-header-logo match-details-header-logo1"></div> -->
                         <img src="{{ $matchDetails[0]->home_team_logo ?? '' }}" alt="team-logo-4">

                         <!-- <span>MLS</span> -->
                     </div>
                     <h6>{{ $matchDetails[0]->home_team_name ?? '' }}</h6>
                 </div>
                 <div class="match-details">
                 <h6>{{ $matchDetails[0]->venue_name ?? ''}}</h6>
                  <p>{{ $matchDetails[0]->venue_city ?? ''}}</p>
                  <span>{{ date('Y-m-d h:i:A',strtotime($matchDetails[0]->fixture_date ?? '')) }}</span>
                 </div>
                 <div class="team-logo">
                     <div class="team_inner">
                         <!-- <span>BL</span> -->
                         <!-- <div class="match-details-header-logo match-details-header-logo2 "></div> -->
                         <img src="{{ $matchDetails[0]->away_team_logo ?? '' }}" alt="team-logo-2">

                     </div>
                     <h6>{{ $matchDetails[0]->away_team_name ?? '' }}</h6>
                 </div>
             </div>

             <div class="tab-content-wrapper">
                 <div class="toggle-target">
                     <a href="#" class="tab active" data-toggle-target=".tab-content-1">Goalkeepers</a>
                     <a href="#" class="tab" data-toggle-target=".tab-content-2">Defenders</a>
                     <a href="#" class="tab" data-toggle-target=".tab-content-3">Midfielders</a>
                     <a href="#" class="tab" data-toggle-target=".tab-content-4">Forward</a>
                 </div>

                 <div class="tab-content tab-content-1 active">
                     <div class="american_leagues-inner-content">
                         <div class="matches-table matche-det">
                             <table>
                                 <thead>
                                     <tr>
                                         <th scope="col" class="">Selected By</th>
                                         <th scope="col">Team</th>
                                         <th scope="col">Age</th>
                                         <th scope="col">Injured</th>
                                     </tr>
                                 </thead>
                                 <tbody class="tbody">
                                 @foreach ($organizedPlayers['Goalkeeper'] as $gk_player)

                                     <tr class="matche-main" data-team-id="{{$gk_player->player_team_id}}" data-player-id="{{$gk_player->player_id}}" data-player-role="G" data-player-name="{{$gk_player->name}}" data-team-logo="{{$gk_player->team_logo}}" data-match-id="{{$matchDetails[0]->fixture_id}}" data-team-name="testing" data-home-team="{{ $matchDetails[0]->home_team_id }}" data-away-team="{{ $matchDetails[0]->away_team_id }}" data-slug-matchid="{{ $matchDetails[0]->id }}">

                                         <td class="player-name">
                                             <p>{{ $gk_player->name }}</p>
                                         </td>
                                         <td class="match-team-logo">
                                             <!-- <a href=""> -->
                                                 <!-- <div class="match-team-logo-inner  match-team-logo-inner1"></div> -->
                                                 <img src="{{$gk_player->team_logo}}" alt="team-logo-2">

                                             <!-- </a> -->
                                         </td>

                                         <td class="match-position">
                                             <p>{{$gk_player->age}}</p>
                                         </td>
                                         <td class="credits_points">
                                             <span>{{ ($gk_player->injured == '1') ?
                                                'Yes' : 'No'}}</span>
                                             <button class="plus player-toggle" data-event="plus">
                                                 <i class="fa-solid fa-plus"></i>
                                             </button>
                                             <button class="minus player-toggle d-none" data-event="minus">
                                                 <i class="fa-solid fa-minus"></i>
                                             </button>
                                         </td>
                                     </tr>
                                     @endforeach
                             
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>


                 <div class="tab-content tab-content-2">
                     <div class="american_leagues-inner-content">
                         <div class="matches-table matche-det">
                             <table>
                                 <thead>
                                     <tr>
                                         <th scope="col" class="">Selected By</th>
                                         <th scope="col">Team</th>
                                         <th scope="col">Age</th>
                                         <th scope="col">Injured</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 @foreach ($organizedPlayers['Defender'] as $def_player)

                                     <tr class="matche-main" data-team-id="{{$def_player->player_team_id}}" data-player-id="{{$def_player->player_id}}" data-player-role="D" data-player-name="{{$def_player->name}}" data-team-logo="{{$def_player->team_logo}}" data-match-id="{{$matchDetails[0]->fixture_id}}" data-team-name="testing" data-home-team="{{ $matchDetails[0]->home_team_id }}" data-away-team="{{ $matchDetails[0]->away_team_id }}" data-slug-matchid="{{ $matchDetails[0]->id }}">

                                         <td class="player-name">
                                             <p>{{ $def_player->name }}</p>
                                         </td>
                                         <td class="match-team-logo">
                                         <img src="{{$def_player->team_logo}}" alt="team-logo-2">

                                             <!-- <a href="">
                                                 <div class="match-team-logo-inner  match-team-logo-inner1"></div>
                                             </a> -->
                                         </td>

                                         <td class="match-position">
                                             <p>{{$def_player->age}}</p>
                                         </td>
                                         <td class="credits_points">
                                             <span>{{ ($def_player->injured == '1') ?
                                                'Yes' : 'No'}}</span>
                                             <button class="plus player-toggle" data-event="plus">
                                                 <i class="fa-solid fa-plus"></i>
                                             </button>
                                             <button class="minus player-toggle d-none" data-event="minus">
                                                 <i class="fa-solid fa-minus"></i>
                                             </button>
                                         </td>
                                     </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>


                 <div class="tab-content tab-content-3">
                     <div class="american_leagues-inner-content">
                         <div class="matches-table matche-det">
                             <table>
                                 <thead>
                                     <tr>
                                         <th scope="col" class="">Selected By</th>
                                         <th scope="col">Team</th>
                                         <th scope="col">Age</th>
                                         <th scope="col">Injured</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 @foreach ($organizedPlayers['Midfielder'] as $mid_player)
                                     <tr class="matche-main" data-team-id="{{$mid_player->player_team_id}}" data-player-id="{{$mid_player->player_id}}" data-player-role="M" data-player-name="{{$mid_player->name}}" data-team-logo="{{$mid_player->team_logo}}" data-match-id="{{$matchDetails[0]->fixture_id}}" data-team-name="testing" data-home-team="{{ $matchDetails[0]->home_team_id }}" data-away-team="{{ $matchDetails[0]->away_team_id }}" data-slug-matchid="{{ $matchDetails[0]->id }}">

                                         <td class="player-name">
                                             <p>{{ $mid_player->name ?? '' }}</p>
                                         </td>
                                         <td class="match-team-logo">
                                         <img src="{{$mid_player->team_logo ?? ''}}" alt="team-logo-2">

                                             <!-- <a href="">
                                                 <div class="match-team-logo-inner  match-team-logo-inner1"></div>
                                             </a> -->
                                         </td>

                                         <td class="match-position">
                                             <p>{{$mid_player->age ?? ''}}</p>
                                         </td>
                                         <td class="credits_points">
                                             <span>{{ ($mid_player->injured  == '1') ?
                                                'Yes' : 'No'}}</span>
                                             <button class="plus player-toggle" data-event="plus">
                                                 <i class="fa-solid fa-plus"></i>
                                             </button>
                                             <button class="minus player-toggle d-none" data-event="minus">
                                                 <i class="fa-solid fa-minus"></i>
                                             </button>
                                         </td>
                                     </tr>
                                     @endforeach
                          
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>


                 <div class="tab-content tab-content-4">
                     <div class="american_leagues-inner-content">
                         <div class="matches-table matche-det">
                             <table>
                                 <thead>
                                     <tr>
                                         <th scope="col" class="">Selected By</th>
                                         <th scope="col">Team</th>
                                         <th scope="col">Age</th>
                                         <th scope="col">Injured</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 @foreach ( $organizedPlayers['Attacker'] as $st_player)

                                     <tr class="matche-main" data-team-id="{{$st_player->player_team_id}}" data-player-id="{{$st_player->player_id}}" data-player-role="F" data-player-name="{{$st_player->name}}" data-team-logo="{{$st_player->team_logo}}" data-match-id="{{$matchDetails[0]->fixture_id}}" data-team-name="testing" data-home-team="{{ $matchDetails[0]->home_team_id }}" data-away-team="{{ $matchDetails[0]->away_team_id }}" data-slug-matchid="{{ $matchDetails[0]->id }}">

                                         <td class="player-name">
                                             <p>{{ $st_player->name }}</p>
                                         </td>
                                         <td class="match-team-logo">
                                         <img src="{{$st_player->team_logo}}" alt="team-logo-2">

                                             <!-- <a href="">
                                                 <div class="match-team-logo-inner  match-team-logo-inner1"></div>
                                             </a> -->
                                         </td>

                                         <td class="match-position">
                                             <p>{{$mid_player->age}}</p>
                                         </td>
                                         <td class="credits_points">
                                             <span>{{ ($st_player->injured == '1') ?
                                                'Yes' : 'No'}}</span>
                                             <button class="plus player-toggle" data-event="plus">
                                                 <i class="fa-solid fa-plus"></i>
                                             </button>
                                             <button class="minus player-toggle d-none" data-event="minus">
                                                 <i class="fa-solid fa-minus"></i>
                                             </button>
                                         </td>
                                     </tr>
                                     @endforeach
                           
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="team-btns">
                 <a href="{{ route('my-team') }}" class="next-btn">Next</a>
             </div>

         </div>
     </div>
 </section>
 <!-- Leagues Content Section End -->
<!-- Modal failure -->
<div class="alert-msg">
    <div class="modal fade" id="errorModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-image">
                    <div class="modal-failure-image modal-images-inner"></div>
                </div>
              <p id="cap-message">

              </p>
            </div>
            <div class="modal-footer">
              <button class="modal-btn btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Ok</button>
            </div>
          </div>
        </div>
      </div>
      {{-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Modal Failure</button> --}}
    </div>
    <!-- Modal Failure -->


    <!-- Modal Success -->
    <div class="alert-msg">
        <div class="modal fade" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel1" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalToggleLabel1">Modal 1</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-image">
                        <div class="modal-success-image modal-images-inner"></div>
                    </div>
                  <p>
                    You can add only 1-3 player.
                  </p>
                </div>
                <div class="modal-footer">
                  <button class="modal-btn btn btn-primary" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal">Ok</button>
                </div>
              </div>
            </div>
          </div>
          {{-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle1" data-bs-toggle="modal">Modal Success</button> --}}
        </div>
        <!-- Modal Success -->

 @endsection

 @section('custom-script')

 <script>
 

         var myTeam = @json(Session::get('myTeam', []));
         $(document).ready(function () {

            autoCheck();


                });
         function autoCheck(){
           
            $('.tbody  tr').each(function () {
             var row = $(this);
             var leagueId = "{{$matchDetails[0]->league->league_id}}";

             // console.log(leagueId,'league_id');
             // console.log(myTeam,'myjson');

             var teamId = row.data('team-id');
             var playerId = row.data('player-id');
             var playerRole = row.data('player-role');
             var playerName = row.data('player-name');

             var playerExists = myTeam.some(function (player) {
                 return player.team_id == teamId && player.player_id == playerId && player
                     .player_role == playerRole && player.player_name == playerName && player
                     .league_id == leagueId;
             });

             if (playerExists) {
                 row.find('.plus').addClass('d-none');
                 row.find('.minus').removeClass('d-none');
             } else {
                 row.find('.plus').removeClass('d-none');
                 row.find('.minus').addClass('d-none');
             }
         });
         }
      

         $('.next-btn').click(function (e) {
             e.preventDefault();

             var nextBtn = $(this);

             $.get("{{ route('current-team-count') }}", function (data, status) {
                 if (data.success == true && data.count != 11) {
                     $("#error-message").html('Your team must have exactly 11 players.');
                     $("#errorModal2").modal('show');
                     console.log('ddd');
                 } else {
                     console.log('testing');
                     window.location.href = nextBtn.attr('href');
                 }
             });
         });

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $(document).on('click', '.player-toggle', function () {

             var team_id = $(this).closest('tr').data('team-id');
             var player_id = $(this).closest('tr').data('player-id');
             var player_role = $(this).closest('tr').data('player-role');
             var leagueId = "{{$matchDetails[0]->league->league_id}}";
             var player_name = $(this).closest('tr').data('player-name');
             var team_logo = $(this).closest('tr').data('team-logo');
             var match_id = $(this).closest('tr').data('match-id');
             var team_name = $(this).closest('tr').data('team-name');
             var homeTeamId = $(this).closest('tr').data('home-team');
             var awayTeamId = $(this).closest('tr').data('away-team');
             var dbMatchId = $(this).closest('tr').data('slug-matchid');

             var button = $(this); // Store reference to the clicked button
             var isPlus = button.hasClass('plus'); // Check if the clicked button is a "plus" button
             var event = $(this).data('event');
             var formData = {
                 team_id: team_id,
                 player_id: player_id,
                 player_role: player_role,
                 leagueId: leagueId,
                 player_name: player_name,
                 event: event,
                 team_logo: team_logo,
                 match_id: match_id,
                 team_name: team_name,
                 homeTeamId: homeTeamId,
                 awayTeamId: awayTeamId,
                 dbMatchId: dbMatchId,
             };

             $.ajax({
                 url: "{{ route('create-team') }}",
                 type: 'POST',
                 data: formData,
                 success: function (response) {
                    console.log(response);
                     if (response.success == true) {
                         if (isPlus) {
                             button.addClass('d-none');
                             button.closest('td').find('.minus').removeClass('d-none');
                             button.parent('td').parent('tr').addClass('select-player');
                         } else {
                             button.addClass('d-none');
                             button.closest('td').find('.plus').removeClass('d-none');
                             button.parent('td').parent('tr').removeClass('select-player');

                         }
                     } else {
                         $("#error-message").html(response.message);
                         $("#errorModal2").modal('show');

                     }
                 },
                 error: function (xhr, status, error) {
                     console.error('Error:', error);
                 }
             });
         });



    

 </script>


 @endsection
