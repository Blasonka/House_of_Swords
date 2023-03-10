<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPwRequest;
use App\Http\Requests\UserRequests\UserPatchRequest;
use App\Mail\PwResetEmail;
use App\Models\Bugreport;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

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

    public function saveImage(Request $request, $UID)
    {
        try {
            // Validate the uploaded file
            // $request->validate([
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // ]);

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Get the uploaded file
            $file = $request->file('image');

            // Get the file name
            $fileName = Auth::user()->Username . '_profilePicture.' . $file->getClientOriginalExtension();

            // Store the file in the storage directory
            $path = $file->storeAs('public/images', $fileName);

            // Save the file name to the database
            if (User::find($UID)->exists()) {
                $user = User::find($UID);

                $user->update([
                    'ProfileImageUrl' => $fileName
                ]);
            }
            return redirect()->back()->with('status', 'Profilkép sikeresen frissítve');;
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }

        // Redirect the user back to the form
    }

    function profilUpdate(UserPatchRequest $request, $UID)
    {
        try {
            if (User::find($UID)->exists()) {
                $user = User::find($UID);

                // Felhasználónév frissítése
                if ($request->Username) {
                    $user->update([
                        'Username' => $request->Username
                    ]);
                    return redirect()->route('user.profil')->with('status', 'Felhasználónév sikeresen frissítve');
                }

                // Jelszó frissítése
                elseif ($request->NewPassword) {
                    $correctPassword = false;
                    $PwdSalt =  Auth::user()->PwdSalt;
                    $randomChar = [];
                    for ($i = 0; $i <= 25; $i++) {
                        array_push($randomChar, chr($i + 65));
                        array_push($randomChar, chr($i + 97));
                    }

                    for ($i = 0; $i <= 50; $i++) {
                        $PwdHash = hash('sha512', $request->Password . $PwdSalt . $randomChar[$i]);
                        if ($PwdHash == Auth::user()->PwdHash) {
                            $correctPassword = true;
                            break;
                        }
                    }

                    if ($correctPassword) {
                        $randomChar = chr(random_int(0, 25) + 65);
                        $PwdSalt = Str::random(20);
                        $user->update([
                            'PwdHash' => hash('sha512', $request->NewPassword . $PwdSalt . $randomChar),
                            'PwdSalt' => $PwdSalt
                        ]);
                        return redirect()->route('user.profil')->with('status', 'Jelszó sikeresen frissítve');
                    } else if (!$correctPassword) {
                        return redirect()->route('user.profil')->with('error', 'Hibás jelszó');
                    }
                } else {
                    return redirect()->route('user.profil')->with('status', 'Hiba!');
                }
            } else {
                return redirect()->route('user.profil')->with('error', 'Item not found, id: ' . $UID);
            }
        } catch (Exception $err) {
            return redirect()->route('user.profil')->with('error', $err->getMessage());
        }
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
