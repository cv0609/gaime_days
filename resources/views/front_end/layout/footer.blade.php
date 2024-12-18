    <!-- Footer Start -->
    <footer class="footer py-5">
        <div class="container">
            <div class="footer-wrap">
                <div class="footer-blocks footer-disclaimer">
                    <div class="logo-bottom">
                        <a href="/"></a>
                    </div>
                </div>              
                <div class="footer-blocks footer-menus">
                    <h3>
                        Menu
                    </h3>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">
                                Homepage
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('personal.data.policy') }}">
                                Personal Data Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('privacy.policy') }}">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms.condition') }}">
                                Terms & Conditions
                            </a>
                        </li>
                    </ul>
                </div>
                 <div class="footer-blocks footer-socials">
                    <h3>
                        Social Tags
                    </h3>
                    <div class="social-tags-container">
                        <a href="https://www.facebook.com/" target="__blank" class="social-icons social-fb">
                            <div class="social-ikons fb"></div>
                        </a>
                        <a href="https://x.com" target="__blank" class="social-icons social-twitter">
                            <div class="social-ikons twitter"></div>
                        </a>
                        <a href="https://www.instagram.com" target="__blank" class="social-icons social-insta">
                            <div class="social-ikons insta">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright-ssl-wrap">
                <div class="copyright-wrap">
                    <p>
                        Copyright &copy; 2024 gaimedays.com All Rights Reserved.
                    </p>
                </div>
                <div class="ssl-container">
                    <div class="ssl-logo bg-center bg-contain bg-no-repeat h-100 w-100"></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
  @section('custom-script')

    @endsection