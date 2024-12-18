 @extends('front_end.layout.main')
  @section('title') Contact-Us  @endsection
  @section('content')


 <!--Contact Us Banner Section Start -->
 <div class="home_banner contact_us">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="banner_box">
                     <h1>Contact Us</h1>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--Contact Us Banner Section End -->


 <!-- After Banner Text Start -->
 <div class="true_banner-text pt-5">
     <div class="container">
         <div class="true_banner-text-wrap">            
             <p>
                 We’re here to help with any questions or concerns you have about your Fantasy Football
                 experience. Whether you need assistance with your Fantasy Soccer team, account setup,
                 or navigating the platform, our dedicated support team is ready to assist you.
             </p>
         </div>
     </div>
 </div>
 <!-- After Banner Text End-->

 <!-- Contact Us Content Section Start -->
 <section class="header-pages-content-section bg-center bg-cover bg-fixed bg-no-repeat pt-5">
     <div class="container">
         <div class="header-pages-content pb-5">

             <div class="header-pages-cards">
                 <h3>
                     How to Reach Us
                 </h3>
                 <p>
                     <strong>
                         Customer Support
                     </strong>
                 </p>
                 <p>
                     For any general inquiries or assistance with Fantasy Sports on Gaimedays, feel free to
                     reach out to us at:

                 </p>
                 <p>
                     <strong>
                         Email:
                     </strong>
                     <a href="mailto:info@gaimedays.com">info@gaimedays.com</a>
                 </p>


                 <p>
                     <strong>
                         Live Chat:
                     </strong>
                     Available 24/7 (click the chat icon in the bottom right corner of the page)
                 </p>
                 <p>
                     <strong>
                         Frequently Asked Questions
                     </strong>
                 </p>
                 <p>
                 Before contacting us, check out our <strong>FAQs</strong>  page for quick answers to common questions
                 about <strong>Fantasy Football</strong> , league setup, scoring systems, and more.
                 </p>
                 <p><a href="#">Visit Our FAQ Page</a></p>

                 <p>
                     <strong>
                         Support Hours</strong>
                 </p>
                 <p>Our team is available during the following hours:</p>
                 <ul>
                     <li><b>Monday to Friday:</b> 9 AM - 6 PM (GMT)</li>
                     <li><b>Saturday:</b> 10 AM - 4 PM (GMT)</li>
                     <li><b>Sunday:</b> Closed</li>
                 </ul>
                 <p>If you contact us outside of these hours, we’ll respond as soon as possible during the next
                     business day.
                 </p>
                 <p><strong>Social Media</strong></p>
                 <p>Stay connected and up-to-date with all things Fantasy Sports! Follow us on social media for
                     the latest updates, player tips, and exclusive offers:</p>
                 <ul>
                     <li>
                         <p>
                             <a href="https://www.facebook.com/">Facebook</a>
                         </p>
                     </li>
                     <li>
                         <p>
                             <a href="https://x.com/i/flow/login">Twitter</a>
                         </p>
                     </li>
                     <li>
                         <p>
                             <a href="https://www.instagram.com/">Instagram</a>
                         </p>
                     </li>
                     <li>
                         <p>
                             <a href="https://www.youtube.com/">YouTube</a>
                         </p>
                     </li>
                 </ul>
                 <p>
                     <strong>Feedback and Suggestions</strong>
                     <p>We are always looking to improve your Fantasy Football and Fantasy Soccer experience.
                         If you have suggestions or feedback to help us enhance our platform, please feel free to
                         share it with us.</p>
                 </p>
                 <p><strong>Submit Feedback:</strong><a href="mailto:feedback@gaimedays.com">feedback@gaimedays.com</a>
                 </p>
                 <p><strong>Media Inquiries</strong></p>
                 <p>For press inquiries or media-related questions, please contact our PR team directly at:</p>
                 <p>Email:<a href="mailto:media@gaimedays.com">media@gaimedays.com</a></p>
             </div>

             <div class="contact-form-section header-pages-cards ">
                 <h3>
                     Contact Form
                 </h3>
                 <p>
                     Please fill out the form below to get in touch with us. A member of our team will respond to
                     your message shortly.
                 </p>
                 <div class="contact-page-form-section">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="header-pages-cards-image contact-card1-image bg-center bg-cover bg-no-repeat ">
                             </div>
                         </div>

                         <div class="col-md-6">
                             <div class="header-pages-cards-content">
                                 <div class="form-wrapper">
                                 @if(Session::has('success'))
                               <span class="alert alert-success text-center" style="width:100%;">{{ Session::get('success') }}</span>
                            @endif
                                     <form action="{{ route('contact.save') }}" method="post" id="contact"
                                         >
                                          @csrf

                                         <fieldset>
                                             <input class="contact-form" placeholder="Your Name" type="text"
                                                 tabindex="1" name="full_name" value="{{ old('full_name') }}" minlength="2" maxlength="100" id="full_name">
                                             <p class="text-danger d-none" id="nameError"></p>

                                         </fieldset>
                                         <fieldset>
                                             <input name="email" class="contact-email" placeholder="Your E-Mail" type="email"
                                                 tabindex="2" value="{{ old('email') }}" id="email">
                                              <p class="text-danger d-none" id="emailError"></p>

                                         </fieldset>
                                         <fieldset>
                                             <select class="contact-topic" name="subject" id="subject" value="{{ old('subject') }}">
                                                 <option value="">Subject</option>
                                                 <option value="Account Support">Account Support</option>
                                                 <option value="League Setup Assistance">League Setup Assistance
                                                 </option>
                                                 <option value="Fantasy Football Questions">Fantasy Football
                                                     Questions</option>
                                                 <option value="Billing & Payments">Billing & Payments</option>
                                                 <option value="Feedback/Suggestions">Feedback/Suggestions</option>
                                                 <option value="other">Other</option>
                                                  <p class="text-danger d-none" id="subjectError"></p>

                                             </select>
                                         </fieldset>
                                         <fieldset>
                                             <textarea name="message" class="message" placeholder="Your Message..."
                                             id="message" minlength="10" maxlength="1000">{{ old('message') }}</textarea>
                                               <p class="text-danger d-none" id="messageError"></p>

                                         </fieldset>
                                         <fieldset>
                                             <button name="submit" type="button" id="contact-btn" class="contact-submit butn"
                                                 data-submit="...Sending">
                                                 Submit </button>
                                               <button type="submit" class="d-none" id="content-form-submit"></button>  
                                         </fieldset>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- choose section start -->
 <section class="choose_us">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="chose_text">
                     <h2>Why Contact Us?</h2>
                     <p><b>1. Technical Support for Fantasy Football</b></p>
                     <p>If you're experiencing issues with your Fantasy Football account, logging in, or any
                         technical difficulties, we’re here to help resolve any concerns.</p>
                     <p><b>2. League Setup Assistance</b></p>
                     <p>Need help setting up your Fantasy Soccer league? Whether it’s creating private leagues or
                         joining public ones, we provide detailed support every step of the way.</p>
                     <p><b>3. Billing & Payments</b></p>
                     <p>For billing inquiries, subscription plans, or payment-related issues, our customer service
                         team will guide you through the process.</p>
                     <p><b>4. Account Management</b></p>
                     <p>Update your account details, manage preferences, or recover your account with ease—our
                         support team is available to assist you.</p>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- choose section end -->
 <!-- Contact Us Content Section End -->
 <!-- get in touch section start -->
 <section class="get_touch">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="gt_text">
                     <h2>Get in Touch Today!</h2>
                     <p>If you have any questions about Fantasy Sports or need help with your team, Gaimedays is
                         here to assist you. Reach out today and our team will ensure your experience is smooth and
                         enjoyable!</p>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- get in touch section end -->


 @endsection

 @section('custom-script')

 <script>
     $(document).ready(function () {
         var response = 'You have to complete the CAPTCHA.';
         @if($errors->has('g-recaptcha-response'))
         $('#captchaModal').modal('show');
         $('#cap-message').text(response);
         @endif


         $('#contact-btn').on('click', function () {
             var valid = true;

             $('.text-danger').addClass('d-none').css('font-size', '15px');

             if ($('#full_name').val().trim() === '') {
                 $('#nameError').removeClass('d-none').text('Full name field is required.');
                 valid = false;
             }

             var email = $('#email').val().trim();

             if ($('#email').val().trim() === '') {
                 $('#emailError').removeClass('d-none').text('Email field is required.');
                 valid = false;
             }

             var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
             if ($('#email').val().trim() != '' && !emailPattern.test(email)) {
                 $('#emailError').removeClass('d-none').text('Please enter a valid email address.');
                 valid = false;
             }

             if ($('#subject').val().trim() === '') {
                 $('#subjectError').removeClass('d-none').text('Subject field is required.');
                 valid = false;
             }

             if ($('#message').val().trim() === '') {
                 $('#messageError').removeClass('d-none').text('Message field is required.');
                 valid = false;
             }

            //  if (!$('#agree').is(':checked')) {
            //      $('#agreeError').removeClass('d-none').text('You must agree to the terms.');
            //      valid = false;
            //  }

             if (valid) {
                 $('#content-form-submit').click();
             }
         });





     });

 </script>


 @endsection
