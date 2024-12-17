<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserRegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   public function login()
    {
        return view('front_end.auth.login');
    }
   public function loginPost(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
           if(Session::has('myTeam')){
              return redirect()->route('my-team');
            }else{
              return redirect('/');
            }  
        }else{
            return redirect()->back()->with('error','Please enter valid email or password');
        }
    }
   public function register()
    {
        return view('front_end.auth.register');
    }

   public function save(RegisterRequest $request)
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password')); // Hash the password
        $user->save();

        if(isset($user) && !empty($user)){

            $user = [
                'first_name' => $request->input('first_name'),
                'user_name' => $request->input('user_name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'phone' => $request->input('phone')
            ];

            //Mail::to($request->input('email'))->send(new UserRegisterMail($user));
        }

        return redirect()->back()->with('success','You are sign up successfully!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('home');
    }
}

