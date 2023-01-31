<?php

namespace App\Http\Controllers;

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
    public function index(Request $r)
    {
        $users = User::all();

        if ($r->query('fields') != null){
            if (str_contains($r->query('fields'), ','))
                $users = User::all(explode(',', $r->query('fields')));
            else
                $users = User::all($r->query('fields'));
        }

        if ($r->query('UID') != null){
            $users = $users->where('UID', '=', $r->query('UID'));
        }

        if ($r->query('Username') != null){
            $users = $users->where('Username', 'LIKE', $r->query('Username'));
        }

        if ($r->query('EmailAddress') != null){
            $users = $users->where('EmailAddress', 'LIKE', $r->query('EmailAddress'));
        }

        if ($r->query('PwdHash') != null){
            $users = $users->where('PwdHash', 'LIKE', $r->query('PwdHash'));
        }

        if ($r->query('PwdSalt') != null){
            $users = $users->where('PwdSalt', 'LIKE', $r->query('PwdSalt'));
        }

        if ($r->query('LastLoginDate') != null){
            $users = $users->where('LastLoginDate', 'LIKE', $r->query('LastLoginDate'));
        }

        $users = QueryController::useRestParamsEnd($r, $users);


        // HA TÖBB MINT EGY TALÁLAT: TÖMBÖT ADJON VISSZA
        // HA CSAK EGY TALÁLAT: A KAPOTT INDEX-ÉRTÉK PÁRBÓL CSAK AZ ÉRTÉKET ADJA VISSZA
        // Ez egy furcsa "feature" miatt szükséges, ahol a tömbök Laravelben
        // automatikusan kulcs-érték párként jönnek létre, ahol a kulcs az érték indexe.
        $result = [];
        foreach ($users as $key => $value) {
            array_push($result, $value);
        }

        if (count($result) == 1) return $result[0];
        else return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserValidationRequest $request)
    {
        $request->validated();
        $randomChar = chr(random_int(0, 25)+65);
        $PwdSalt = Str::random(20);

        User::create([
            'Username' => $request->input('Username'),
            'EmailAddress' => $request->input('EmailAddress'),
            'PwdHash' => hash('sha512', $request->input('PwdHash') . $PwdSalt . $randomChar),
            'PwdSalt' => $PwdSalt
        ])->sendEmailVerificationNotification();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }
}
