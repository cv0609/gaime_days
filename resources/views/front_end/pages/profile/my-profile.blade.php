@extends('front_end.layout.main')
@section('title') My-Profile  @endsection
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
                        My Profile
                    </h3>
                </li>
            </ul>
        </div>
    </div>
</section>
<!--Leagues Pages Banner Section End -->

<!-- Leagues Content Section Start -->
<section class="my-profile py-10">
    <div class="container">
        <div class="mmy-profile-inner">
            @include('front_end.pages.profile.profile-sidebar')
            <div class="col-sec">
                <div class="user-content-update">
                    <div class="">
                        <div class="tab-content tab-content-1 active">
                            <div class="user-content-box">
                                <form action="{{ route('profile.update') }}" method="POST" class="mt-60 ">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <input type="text" placeholder="Name" class="form-control para" id="name"
                                                required="required" autocomplete="off" name="first_name" value="{{ Auth::user()->first_name }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" placeholder="Username" class="form-control para"
                                                id="username" name="user_name" required="required" autocomplete="off" value="{{ Auth::user()->user_name }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" placeholder="E-mail" class="form-control para"
                                                id="email" required="required" name="email" autocomplete="off" value="{{ Auth::user()->email  }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="tel" placeholder="Phone Number" class="form-control para"
                                                id="Phone" name="phone" autocomplete="off" value="{{ Auth::user()->phone  }}" required="required" autocomplete="off">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Leagues Content Section End -->
@endsection
