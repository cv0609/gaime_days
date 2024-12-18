@extends('front_end.layout.main')
@section('title') Home  @endsection
@section('content')
<!-- Home Page Banner Section Start -->
<div class="home_banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner_box">
                    <h1>Gaime Days</h1>
                    <p>The New Home Of Fantasy Football</p>
                    <a href="" class="home-banner-button">Play Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Home Page Banner Section End-->

<!-- Home About Us Section Start -->
<section class="our_leagues">
    <div class="container">
        <h2 class="section-heading text-center pb-5">
            Our Leagues
        </h2>
        <div class="row">
            <div class="col-12">
                <div class="both_into">
                    <div class="image_side one">
                    </div>
                    <div class="text_side">
                        <h2>Private Leagues</h2>
                        <span>"Compete with Your Inner Circle."</span>
                        <p>Take the game to the next level by creating your own private league! Invite friends,
                            family,
                            or colleagues to join the ultimate battle of football knowledge. Set up a league in
                            seconds,
                            customize the rules, and prove who’s the best manager week after week. Whether it’s
                            bragging
                            rights or friendly banter, Private Leagues bring the competition closer to home.</p>
                        <h3>Features:</h3>
                        <ul>
                            <li>Custom league names and settings.</li>
                            <li>Invite-only participation.</li>
                            <li>Weekly leaderboards to fuel the rivalry.</li>
                        </ul>
                    </div>
                </div>
                <div class="both_into">
                    <div class="image_side two">
                    </div>
                    <div class="text_side">
                        <h2>Public Leagues</h2>
                        <span>"Join the Global Football Community."</span>
                        <p>Step into the big leagues and test your skills against managers from around the world.
                            Public Leagues are open to everyone, offering a thrilling chance to compete with
                            passionate football fans. Rise through the ranks, climb the leaderboard, and see if you
                            have what it takes to be the best!</p>
                        <h3>Why Join?</h3>
                        <ul>
                            <li>Compete with a massive pool of players.</li>
                            <li>Compare strategies and squads globally.</li>
                            <li>Showcase your football expertise to a wider audience.</li>
                        </ul>
                    </div>
                </div>
                <div class="both_into">
                    <div class="image_side three">
                    </div>
                    <div class="text_side">
                        <h2>Head-to-Head Leagues</h2>
                        <span>"One-on-One: The Ultimate Managerial Duel."</span>
                        <p>Head-to-Head Leagues add an extra layer of excitement. Each game week, you’re matched
                            against another manager in a direct clash. Whoever scores the most points wins the
                            fixture and earns three league points. It’s a football face-off every week, and every
                            point counts in the race for the top!</p>
                        <h3>Key Features:</h3>
                        <ul>
                            <li>Weekly matchups against league members.</li>
                            <li>Dynamic league tables based on head-to-head results.</li>
                            <li>Playoffs at the end of the season for ultimate glory.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home About Us Section End -->
<section class="features-section">
    <div class="container">
        <h2>Why Choose Gaimedays?</h2>

        <div class="feature">
            <div class="feature-icon">&#128197;</div>
            <div class="feature-text">
                <h3>Real-Time Updates</h3>
                <p>Stay on top of every match with live stats and instant player points.</p>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">&#128205;</div>
            <div class="feature-text">
                <h3>Custom Leagues</h3>
                <p>Create leagues that fit your style—private, public, or head-to-head.</p>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">&#128187;</div>
            <div class="feature-text">
                <h3>Easy-to-Use Interface</h3>
                <p>Intuitive design makes managing your team and tracking your league effortless.</p>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">&#128202;</div>
            <div class="feature-text">
                <h3>Exclusive Insights</h3>
                <p>Get expert tips, player recommendations, and weekly performance analysis.</p>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">&#127942;</div>
            <div class="feature-text">
                <h3>Global Leaderboards</h3>
                <p>Compete with managers worldwide and see how you stack up.</p>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">&#127873;</div>
            <div class="feature-text">
                <h3>Exciting Rewards</h3>
                <p>Earn trophies, badges, and the chance to win real-world prizes.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-script')
<script>
    $(document).ready(function () {
        @if(Session::has('error'))
        var flashMessage = "<?= Session::get('error') ?>";
        $("#error-message").html(flashMessage)
        $("#errorModal").modal('show');
        @endif
    })

</script>
@endsection
