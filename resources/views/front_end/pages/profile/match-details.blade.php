@extends('front_end.layout.main')
@section('content')

@php
   $PointCalculationService = app(App\Services\PointCalculationService::class);
   use Carbon\Carbon;
@endphp

   <!--====sign up section start====-->
<section class="premier_bg premier_players">
         <div class="container">
            <div class="leagure_container">
               <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-gray-900 py-10">
                  <a href="{{ route('profile.matches') }}" class="back-btn">
                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff">
                        <path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/>
                     </svg>
                  </a>
                  <!-- Component Start -->
                  <h1 class="font-medium">
                     My players
                  </h1>
                  <div class="flex flex-col mt-6">
                     <div
                        class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                           class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                           <div class="palyer-header">
                              <div class="team-logo">
                                 <img src="{{ $matchDetails->home_team_logo ?? '' }}" alt="team-logo-4">
                                 {{-- <span>SHL</span> --}}
                                 <h6>{{ $matchDetails->home_team_name ?? '' }}</h6>
                              </div>
                              <div class="match-details">
                                 <h6>{{ $matchDetails->venue_name ?? '' }}</h6>
                                 <p>{{ $matchDetails->venue_city ?? ''}}</p>
                                 <span>{{ date('Y-m-d h:i a', strtotime($matchDetails->fixture_date ?? '')) }}</span>
                              </div>

                              <div class="team-logo">
                                 {{-- <span>CNGZ</span> --}}
                                 <img src="{{ $matchDetails->away_team_logo ?? '' }}" alt="team-logo-2">
                                 <h6>{{ $matchDetails->away_team_name ?? '' }}</h6>
                              </div>
                           </div>
                          
                           <div class="matches-table">
                              <div class="div-tbl">
                                 <table
                                    class="table table-light table-striped table-hover table-sm">
                                    <thead
                                       class=" text-uppercase">
                                       <tr>
                                          <th scope="col">Logo</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Position</th>
                                          <th scope="col">Socure</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                       @foreach ($teams[0]->teamDetails ?? [] as $data)
                                       @php
                                          $points = $PointCalculationService->getPlayerStatistics(Auth::user()->id,$matchId,$data->player_id);
                                       @endphp
                                          <tr>
                                             <td class="match-team-logo">
                                                <img src="{{$data->player_team_logo}}" alt="team-logo-3">
                                             </td>
                                             <td class="player-name">
                                                <p>{{$data->player_name}}</p>
                                             </td>
                                             <td class="match-position">
                                                <p>{{$data->player_pos}}</p>
                                             </td>
                                             <td class="match-score">
                                                <h4>{{ $points }}</h4>
                                             </td>
                                          </tr>
                                       @endforeach
                                      
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           {{-- <div class="team-btns">
                              <a href="team-view.html" class="next-btn">next</a>
                           </div> --}}
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Component End  -->
            </div>
         </div>
         </div>
      </section>

    <!--====sign up section end====-->

       <!-- alert-msg popup start -->
       <div class="alert-msg">
           <div class="modal fade" id="errorModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                   <div class="modal-header">
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#d30f0f"><path d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm-40-160h80v-240h-80v240Zm40 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                    </span>
                       <h4 id="error-message"></h4>
                   </div>
                   <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ok</button>
                   </div>
               </div>
               </div>
           </div>
       </div>
        <!-- alert-msg popup end -->

       <!-- alert-msg popup start -->
       <div class="alert-msg">
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <span>
                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#00c900"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q65 0 123 19t107 53l-58 59q-38-24-81-37.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160q133 0 226.5-93.5T800-480q0-18-2-36t-6-35l65-65q11 32 17 66t6 70q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-56-216L254-466l56-56 114 114 400-401 56 56-456 457Z"/></svg>
                 </span>
                    <h4 id="success-message"></h4>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ok</button>
                </div>
            </div>
            </div>
        </div>
    </div>
     <!-- alert-msg popup end -->

 @endsection

 @section('custom-script')



 @endsection
