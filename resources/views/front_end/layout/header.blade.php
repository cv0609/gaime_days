       <!-- Header Section Start -->
       <header class="header-container">
        <div class="container">
            <nav class="navbar">
                <div class="logo-container">
                    <a href="{{ route('home') }}" class="logo-link">
                    </a>
                </div>

                <div class="menu-toggle-btn"></div>

                <div class="navbar-menu">
                    <ul>
                        <li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('how.to.play') }}" class="{{ Route::is('how.to.play') ? 'active' : '' }}">Playing Guide</a></li>
                        <li><a href="{{ route('leagues') }}" class="{{ Route::is('leagues') ? 'active' : '' }}">Play now</a></li>
                        <li><a href="{{ route('about.us') }}" class="{{ Route::is('about.us') ? 'active' : '' }}">About Us</a></li>
                        <li><a href="{{ route('contact.us') }}" class="{{ Route::is('contact.us') ? 'active' : '' }}">Contact Us</a></li>
                    </ul>
                    @if(!Auth::check())

                    <a href="{{ route('register') }}" class="btn signup-btn">Sign Up</a>
                    <a href="{{ route('login') }}" class="btn login-btn">Login</a>
                    @endif
                    @if(Auth::check())

                    <div class="profile">
                        <div class="avatar">
                            <div class="avatar-content">
                                <a href="#">
                                    <div class="profile-image">
                                    <img src="{{(!empty(Auth::user()->image)) ? asset(Auth::user()->image) : asset('assets/images/dummy.jpg') }}" alt="dp">
                                    </div>
                                    <span>{{ ucfirst(Auth::user()->first_name) }}</span>
                                </a>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                </svg>
                            </div>
                            <div class="dropdown">
                                <ul>
                                    <li><a href="{{ route('profile.profile') }}">
                                            <div class="profile-dropdown-options profile-image-dropdown"></div>My
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.matches') }}">
                                            <div class="profile-dropdown-options profile-image-stadium"></div>My Matches
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            <div class="profile-dropdown-options profile-image-logout"></div>Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="menu-close-btn"></div>
                </div>
            </nav>
        </div>
    </header>

    <div id="cookieNotice" class="light display-right" style="display: none;">
        <div id="closeIcon" style="display: none;">
        </div>
        <div class="title-wrap">
            <h4>Cookie Consent</h4>
        </div>
        <div class="content-wrap">
            <div class="msg-wrap">
                <p>This website uses cookies or similar technologies, to enhance your browsing experience and provide personalized recommendations. By continuing to use our website, you agree to our  <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a></p>
                <div class="btn-wrap">
                    <button class="btn-primary" onclick="acceptCookieConsent();">Accept</button>
                </div>
            </div>
        </div>
    </div>
