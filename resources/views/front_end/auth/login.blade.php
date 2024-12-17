@extends('front_end.layout.main')
@section('content')
<!-- Login Page Form Section Start -->
<section class="login_signup_form">
    <div class="container">
        <div class="login-signup-wrapper">
            <div class="form-container">
                <form action="{{ route('login.post') }}" method="POST" id="login-signup">
                    @csrf
                   <h3 class="text-center">Login</h3>
                    @if(Session::has('error'))
                    <span class="alert alert-danger">{{ Session::get('error') }}</span>
                    @endif
                    <fieldset>
                        <input name="email"  placeholder="Enter Your Email" type="email" tabindex="1" autofocus>
                        @error('email')
                     <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </fieldset>
                    <fieldset>
                        <input name="password" id="password-field" placeholder="Enter Password" type="text" tabindex="2" >
                        @error('password')
                         <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="login-submit" data-submit="...Sending">
                            LOGIN</button>
                    </fieldset>
                    <p class="jump-text">
                        Don't have an account yet? <a href="{{ route('register') }}">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Login Page Form Section End -->
@endsection

@section('custom-script')

<script>
    $(window).on('load', function () {
        $('#email, #password-field').val(''); // Clear email and password fields after page load
    });

    $(document).ready(function () {
        $('#email, #password-field').val('');
        var response = 'You have to complete the CAPTCHA.';
        @if($errors-> has('g-recaptcha-response'))
        $('#captchaModal').modal('show');
        $('#cap-message').text(response);
        @endif
    });

</script>


@endsection
