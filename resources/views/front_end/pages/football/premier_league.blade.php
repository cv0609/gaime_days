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
                        Leagues
                    </h3>
                </li>
            </ul>
        </div>
    </div>
</section>
<!--Leagues Pages Banner Section End -->

<!-- Leagues Content Section Start -->
<section class="american_leagues leagues">
    <div class="container">
        <div class="american_leagues-inner">

            <h2>{{ date('Y') }} Season</h2>
            @if(Session::has('success'))
            <span class="alert alert-success text-center" style="width:100%;">{{ Session::get('success') }}</span>
            @elseif(Session::has('error'))
            <span class="alert alert-danger text-center" style="width:100%;">{{ Session::get('error') }}</span>

          @endif
            <div class="team-view-sec">

            </div>
            <div class="american_leagues-inner-content">
                <div class="leagues-table">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">League</th>
                                <th scope="col">Type</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($leagues as $key => $league)
                        {{-- @php
                          $check_match = checkMatch($league['league']['id']);
                          dump($check_match);
                        @endphp --}}
                          {{-- @if($check_match == true) --}}
                                    <tr>
                                        <td class="league-logo">
                                            <!-- <div class="league-logo-inner  league-logo-inner1"></div> -->
                                            <img class="lazy-load" data-src="{{ $league->logo }}" alt="league-logo">

                                            <a href="{{ route('leagueMatches',['leagueId'=>$league->id]) }}"></a>
                                        </td>
                                        <td>
                                            <h6>
                                            {{ $league->name }}
                                            </h6>
                                        </td>
                                        <td>
                                            <p>{{ $league->type }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $league->start_date }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $league->end_date }}</p>
                                        </td>
                                    </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Leagues Content Section End -->
@endsection

@section('custom-script')
<script>
  lazyLoading();
    let table = new DataTable('#myTable');
    function lazyLoading() {

let lazyImages = [].slice.call(document.querySelectorAll("img.lazy-load"));

if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                let lazyImage = entry.target;
                lazyImage.src = lazyImage.dataset.src;
                lazyImage.classList.remove("lazy-load");
                lazyImageObserver.unobserve(lazyImage);
            }
        });
    });

    lazyImages.forEach(function (lazyImage) {
        lazyImageObserver.observe(lazyImage);
    });
} else {
    // Fallback for older browsers
    lazyImages.forEach(function (lazyImage) {
        lazyImage.src = lazyImage.dataset.src;
    });
}
}
    document.addEventListener("DOMContentLoaded", function () {
        lazyLoading();
    });


    $(document).ready(function () {
        $(document).on('click', '.dt-paging-button', function () {
            lazyLoading();
        });

        $('.dt-input').on('keyup change', function () {
            lazyLoading();
        });
    });


   

</script>
@endsection
