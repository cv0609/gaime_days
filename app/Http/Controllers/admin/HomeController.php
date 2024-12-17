<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class HomeController extends Controller
{
    public function getUsersList(){
        $users = User::all();
        return view('admin.pages.users',compact('users'));
    }

    public function contactList(){
        $contact = ContactUs::all();
        return view('admin.pages.contact',compact('contact'));
    }
}
