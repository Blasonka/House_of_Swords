<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequests\UserCreationRequest as CreationRequest;
use App\Http\Requests\UserRequests\UserPatchRequest as PatchRequest;
use App\Mail\VerificationEmail;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreationRequest $request)
    {
        $randomChar = chr(random_int(0, 25) + 65);
        $PwdSalt = Str::random(20);

        try {
            $user =  User::create([
                'Username' => $request->input('Username'),
                'EmailAddress' => $request->input('EmailAddress'),
                'EmailVerificationToken' => Str::random(32),
                'PwdHash' => hash('sha512', $request->input('PwdHash') . $PwdSalt . $randomChar),
                'PwdSalt' => $PwdSalt,
                'Role' => 0
            ]);

            Mail::to($user->EmailAddress)->send(new VerificationEmail($user));
            Auth::login($user);
                    if ($user->IsEmailVerified == 0) {
                        return redirect()->route('verify');
                    } else {
                        return redirect()->route('user.profil');
                    }
        } catch (Exception $e) {
            return response()->back()->with('errors', 'A regisztráció sikertelen! Kérjük próbálja újra később.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::find($id);
            if (!empty($user)) {
                return response()->json($user);
            } else {
                return response()->json(['message' => 'Item not found, id: ' . $id], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Database error'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByName($username)
    {
        try {
            $users = [];

            foreach (User::all()->where('Username', 'LIKE', $username)->toArray() as $key => $value) {
                array_push($users, $value);
            }

            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Database error.'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (User::find($id)->exists()) {
                User::find($id)->delete();
                return response()->json(['message' => 'Item was deleted, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'Item not found, id: ' . $id], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Database error.'], 400);
        }
    }

    public function loginRequest(Request $request) {
        session()->flush();

        $username = $request->input('Username', null);
        $pwd = $request->input('Password', null);

        if (!$username || !$pwd) {
            return response()->json([
                'success' => false,
                'message' => 'Username or password is missing!'
            ], 400);
        }

        $user = User::all()->firstWhere('Username', '=', $username);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User does not exist!'
            ], 404);
        }

        $isPasswordCorrect = false;
        foreach (range('a', 'z') as $i) {
            $currentHash = hash('sha512', $pwd . $user->PwdSalt . $i);

            if ($currentHash == $user->PwdHash){
                $isPasswordCorrect = true;
                break;
            }
        }
        foreach (range('A', 'Z') as $i) {
            $currentHash = hash('sha512', $pwd . $user->PwdSalt . $i);

            if ($currentHash == $user->PwdHash){
                $isPasswordCorrect = true;
                break;
            }
        }

        if (!$isPasswordCorrect) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials!'
            ], 401);
        }

        // AUTHENTICATION SUCCESSFUL
        $user->GameSessionToken = Str::random(32);
        $user->LastOnline = date('Y-m-d H:i:s');
        $user->save();

        Auth::login($user);

        return response()->json(Auth::user(), 200);
    }
}
