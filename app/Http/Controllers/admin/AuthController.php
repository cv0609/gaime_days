<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\ContactUs;
use Mockery\Matcher\Contains;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function authLogin(AdminLoginRequest $request)
    {
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return redirect()->route('admin.dashboard')->with('success','Admin login successfully.');
        }else{
            return back()->with('error','Your Name or password is Wrong!');
        }
    }

    public function dashboard(){
        $users_count = User::count();
        $contacts_count = ContactUs::count();
        return view('admin.pages.dashboard',compact('users_count','contacts_count'));
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login');
    }
}
