<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function index(){
        return view('home');
    }

    function about(){
        return view('about');
    }

    function register(){
        return view('register');
    }

    function login(){
        return view('login');
    }

    function notFound($params){
        return view('404', [$params]);
    }
}
