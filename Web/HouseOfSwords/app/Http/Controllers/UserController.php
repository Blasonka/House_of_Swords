<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\UserPatchRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserValidationRequest;
use Illuminate\Support\Str;

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

        // HA TÖBB MINT EGY TALÁLAT: TÖMBÖT ADJON VISSZA
        // HA CSAK EGY TALÁLAT: A KAPOTT INDEX-ÉRTÉK PÁRBÓL CSAK AZ ÉRTÉKET ADJA VISSZA
        // Ez egy furcsa "feature" miatt szükséges, ahol a tömbök Laravelben
        // automatikusan kulcs-érték párként jönnek létre, ahol a kulcs az érték indexe.

        // $result = [];
        // foreach ($users as $key => $value) {
        //     array_push($result, $value);
        // }

        // if (count($result) == 1) return $result[0];
        // else return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserValidationRequest $request)
    {
        $randomChar = chr(random_int(0, 25)+65);
        $PwdSalt = Str::random(20);

        User::create([
            'Username' => $request->input('Username'),
            'EmailAddress' => $request->input('EmailAddress'),
            'PwdHash' => hash('sha512', $request->input('PwdHash') . $PwdSalt . $randomChar),
            'PwdSalt' => $PwdSalt
        ]);
        return('pog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPatchRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return `User no. $id destroyed.`;
    }
}
