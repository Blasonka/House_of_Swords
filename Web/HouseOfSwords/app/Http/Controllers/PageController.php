<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPwRequest;
use App\Mail\PwResetEmail;
use App\Models\Bugreport;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;

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

    function bugReport()
    {
        return view('report');
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

    function resetpw($token)
    {
        try {
            $user = User::where('EmailVerificationToken', $token)->first();
            if ($user) {
                return view('users.resetpw', ['user' => $user]);
            };
        } catch (Exception $th) {
            return response()->json(['Sorry, something went wrong', $th->getMessage()]);
        };
    }

    function newpw(ResetPwRequest $request)
    {
        try {
            $user = User::find($request->UID);
            if ($user) {
                $randomChar = chr(random_int(0, 25) + 65);
                $PwdSalt = Str::random(20);
                $user->update([
                    'PwdHash' => hash('sha512', $request->input('PwdHash') . $PwdSalt . $randomChar),
                    'PwdSalt' => $PwdSalt,
                    'EmailVerificationToken' => null
                ]);

                Auth::login($user);
                if ($user->IsEmailVerified == 0) {
                    return redirect()->route('verify');
                } else {
                    return redirect()->route('user.profil');
                }
            };
        } catch (Exception $th) {
            return response()->back()->with('error', 'A jelszó visszaállítása nem sikerült! Kérjük próbálja újra később');
        };
    }

    function admin()
    {
        $bugs = Bugreport::all();
        return view('admin.index', ['bugs' => $bugs]);
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

        try {
            for ($i = 0; $i <= 50; $i++) {
                $Password = hash('sha512', $request->PwdHash . $PwdSalt . $randomChar[$i]);
                $user = User::where('Username', $request->Username)->where('PwdHash', $Password)->first();
                if ($user) {
                    Auth::login($user);
                    if ($user->IsEmailVerified == 0) {
                        return redirect()->route('verify');
                    } else {
                        return redirect()->route('user.profil');
                    }
                };
            };
            if (!$user) {
                return redirect()->back()->withErrors(['PwdHash' => 'Hibás jelszó']);
            }
        } catch (Exception $th) {
            return redirect()->back()->withErrors([$th]);
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

    function loginshow()
    {
        return view('users.login');
    }
    function forgottenpw()
    {
        return view('users.forgottenpw');
    }

    function notFound($params)
    {
        return view('404', [$params]);
    }
}
