<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    function index()
    {
        return view('home');
    }

    function about()
    {
        return view('about');
    }

    function download()
    {
        return view('download');
    }

    function register()
    {
        return view('users.register');
    }

    function profil()
    {
        return view('users.profil');
    }

    function verify()
    {
        return view('users.verify');
    }

    function admin()
    {
        return view('admin.index');
    }

    function owner()
    {
        return view('owner.index');
    }

    function login(LoginRequest $request)
    {
        $PwdSalt =  User::where('Username', $request->Username)->value('PwdSalt');
        $randomChar = [];
        for ($i = 0; $i <= 25; $i++) {
            array_push($randomChar, chr($i + 65));
            array_push($randomChar, chr($i + 97));
        };

        for ($i = 0; $i <= 50; $i++) {
            $Password = hash('sha512', $request->PwdHash . $PwdSalt . $randomChar[$i]);
            $user = User::where('Username', $request->Username)->where('PwdHash', $Password)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('index');
            };
        };
        if (!$user){
            return redirect()->back()->withInput();
        }
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('index');
    }

    function loginshow()
    {
        return view('users.login');
    }

    function notFound($params)
    {
        return view('404', [$params]);
    }
}
