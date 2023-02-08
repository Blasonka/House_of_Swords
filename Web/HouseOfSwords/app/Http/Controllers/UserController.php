<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequests\UserCreationRequest as CreationRequest;
use App\Http\Requests\UserRequests\UserPatchRequest as PatchRequest;
use Illuminate\Support\Str;
use Exception;

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
        $randomChar = chr(random_int(0, 25)+65);
        $PwdSalt = Str::random(20);

        try {
            return User::create([
                'Username' => $request->input('Username'),
                'EmailAddress' => $request->input('EmailAddress'),
                'PwdHash' => hash('sha512', $request->input('PwdHash') . $PwdSalt . $randomChar),
                'PwdSalt' => $PwdSalt
            ]);
        }
        catch(Exception $e) {
            return response()->json(['message'=>'Database error'],400);
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
            }
            else {
                return response()->json(['message'=>'Item not found, id: '.$id],404);
            }
        }
        catch (Exception $e) {
            return response()->json(['message'=>'Database error'],400);
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
            return User::all()->where('Username', $username);
        }
        catch (Exception $e) {
            return response()->json(['message'=>'Database error.'],400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatchRequest $request, $id)
    {
        try {
            if (User::find($id)->exists()) {
                $user = User::find($id);
                $user->update($request->all());
                return response()->json(['message'=>'Item was updated, id: '.$id],200);
            }
            else {
                return response()->json(['message'=>'Item not found, id: '.$id],404);
            }
        }
        catch(Exception $e) {
            return response()->json(['message'=>'Database error'],400);
        }
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
                return response()->json(['message'=>'Item was deleted, id: '.$id],200);
            }
            else {
                return response()->json(['message'=>'Item not found, id: '.$id],404);
            }
        }
        catch(Exception $e) {
            return response()->json(['message'=>'Database error.'],400);
        }
    }
}
