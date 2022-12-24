<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function index(){
        return view('home');
    }

    function about(){
        return view('about');
    }

    function register(){
        return view('users.register');
    }

    function profil(){
        return view('users.profil');
    }

    function login(LoginRequest $request){
        //$PwdSalt =
        $credentials = Auth::attempt([
            'Username' => $request->Username,
            'PwdHash' => $request->PwdHash,
            //'PwdHash' => hash('sha512', $request->input('PwdHash') . $PwdSalt . $randomChar)
        ]);
        // error_log($request->PwdHash);
        if($credentials){
            return redirect()->intended();
        }
        else{
            return redirect()->to('/login')->withErrors(trans('auth.failed'));
        }
    }

    function loginshow(){
        return view('users.login');
    }

    function notFound($params){
        return view('404', [$params]);
    }
}
