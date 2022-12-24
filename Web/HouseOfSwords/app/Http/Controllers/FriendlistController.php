<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendlist;

class FriendlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $friends = Friendlist::all();

        if ($r->query('fields') != null){
            if (str_contains($r->query('fields'), ','))
                $friends = Friendlist::all(explode(',', $r->query('fields')));
            else
                $friends = Friendlist::all($r->query('fields'));
        }

        if ($r->query('RelationID') != null){
            $friends = $friends->where('RelationID', '=', $r->query('RelationID'));
        }

        if ($r->query('FriendID') != null){
            $friends = $friends->where('FriendID', '=', $r->query('FriendID'));
        }

        if ($r->query('Users_UID') != null){
            $friends = $friends->where('Users_UID', '=', $r->query('Users_UID'));
        }

        $friends = QueryController::useRestParamsEnd($r, $friends);

        return $friends;
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
    public function store(Request $request)
    {
        //
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
