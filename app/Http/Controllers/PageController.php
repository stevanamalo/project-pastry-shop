<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    //
    public function showLogin()
    {
        if (Session::has("remember")) {
            # code...
            return redirect("/user");
        }
        else if(Session::has("rememberadmin")){
            return redirect("/admin");
        }
        return view('login');
    }



    public function showRegister()
    {
        if (Session::has("remember")) {
            # code...
            return redirect("/user");
        }
        else if(Session::has("rememberadmin")){
            return redirect("/admin");
        }
        return view('register');
    }



    public function showUser()
    {
        return view('user.homeUser');
    }

    public function showAdmin()
    {
        return view('admin.homeAdmin');
    }




    public function showProfile()
    {
        if (!Session::has("userlog")) {
            # code...
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }
        return view('user.profile');
    }
    public function showEditProfile()
    {
        if (!Session::has("userlog")) {
            # code...
            return redirect()->route("login")->with('msg', "Harus Login Dahulu");
        }
        return view('user.editU');
    }
}
