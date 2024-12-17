@extends('front_end.layout.main')
@section('content')
<!-- Signup Page Form Section Start -->
<section class="login_signup_form">
    <div class="container">
        <div class="login-signup-wrapper">
            <div class="form-container">
                <form action="{{ route('register.post') }}" method="POST" id="login-signup">
                    @csrf
                    <h3 class="text-center">Sign Up</h3>
                    @if(Session::has('success'))
                     <span class="alert alert-success text-center">{{ Session::get('success') }}</span>
                    @endif
                    <fieldset>
                        <input name="first_name" value="{{ old('first_name') }}" placeholder="Your Name" type="text" tabindex="1" >
                        @error('first_name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <input name="user_name" value="{{ old('user_name') }}" placeholder="Choose Username" type="text" tabindex="2"  autofocus>
                        @error('user_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <input name="email" value="{{ old('email') }}" placeholder="Enter Your Email" type="email" tabindex="3" >
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <input name="phone" placeholder="Phone Number (Optional)" id="Phone" type="text" tabindex="4" value="{{ old('phone') }}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <input name="password" placeholder="Choose Password" type="password" tabindex="5" id="password-field">
                       @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <input name="password_confirmation" id="con_password" placeholder="Re-enter Password" type="password" tabindex="6">
                    </fieldset>

                    <fieldset>
                        <button name="submit" type="submit" id="signup-submit" data-submit="...Sending">Sign
                            Up</button>
                    </fieldset>
                    <p class="jump-text">
                        Already have an account? <a href="{{ route('login') }}">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Signup Page Form Section End -->
@endsection

@section('custom-script')

<script>
    $(document).ready(function () {
        var response = 'You have to complete the CAPTCHA.';
        @if($errors->has('g-recaptcha-response'))
        $('#captchaModal').modal('show');
        $('#cap-message').text(response);
        @endif
    });

</script>


@endsection
