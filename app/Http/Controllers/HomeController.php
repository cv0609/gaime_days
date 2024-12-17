<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;
use App\Services\ApiFootballService;
use App\Models\League;

class HomeController extends Controller
{
    protected $apiFootballService;

    public function __construct(ApiFootballService $apiFootballService)
    {
        $this->apiFootballService = $apiFootballService;

    }
   public function index()
    {
        $leagues = League::whereHas('leagueMatches')->limit(25)->get();
        return view('front_end.pages.home',compact('leagues'));
    }

    public function aboutUs()
     {
        return view('front_end.pages.about');
     }

    public function contactUs()
    {
       return view('front_end.pages.contact');
    }

    public function contactSave(ContactRequest $request){
       $full_name = $request->full_name ?? '';
       $email = $request->email ?? '';
       $subject = $request->subject ?? '';
       $message = $request->message ?? '';

       $contact = [
          'full_name' => $full_name,
          'email' => $email,
          'subject' => $subject,
          'message' => $message
       ];

       if(isset($full_name,$email,$subject,$message)){

         ContactUs::create($contact);

          //Mail::to('ashishyadav.avology@gmail.com')->send(new ContactMail($contact));
       }
       return redirect()->back()->with('success','Your contact query sent successfully.');
    }

    public function howToPlay()
     {
        return view('front_end.pages.how_to_play');
     }

     public function termsCondition(){
       return view('front_end.pages.terms-condition');
     }

     public function privacyPolicy(){
       return view('front_end.pages.privacy-policy');
     }

     public function personalDataPolicy(){
      return view('front_end.pages.personal-data-policy');
    }
}
