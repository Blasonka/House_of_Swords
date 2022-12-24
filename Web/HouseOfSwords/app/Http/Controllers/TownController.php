<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Http\Requests\TownCreationRequest;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $towns = Town::all();

        if ($r->query('fields') != null){
            if (str_contains($r->query('fields'), ','))
                $towns = Town::all(explode(',', $r->query('fields')));
            else
                $towns = Town::all($r->query('fields'));
        }

        if ($r->query('TownID') != null){
            $towns = $towns->where('TownID', '=', $r->query('TownID'));
        }

        if ($r->query('HappinessValue') != null){
            $towns = $towns->where('HappinessValue', '=', $r->query('HappinessValue'));
        }

        if ($r->query('Wood') != null){
            $towns = $towns->where('Wood', '=', $r->query('Wood'));
        }

        if ($r->query('Stone') != null){
            $towns = $towns->where('Stone', '=', $r->query('Stone'));
        }

        if ($r->query('Metal') != null){
            $towns = $towns->where('Metal', '=', $r->query('Metal'));
        }

        if ($r->query('Gold') != null){
            $towns = $towns->where('Gold', '=', $r->query('Gold'));
        }

        if ($r->query('Campaign_Lvl') != null){
            $towns = $towns->where('Campaign_Lvl', '=', $r->query('Campaign_Lvl'));
        }

        if ($r->query('Coordinates') != null){
            $towns = $towns->where('Coordinates', 'like', $r->query('Coordinates'));
        }

        if ($r->query('Users_UID') != null){
            $towns = $towns->where('Users_UID', '=', $r->query('Users_UID'));
        }

        $towns = QueryController::useRestParamsEnd($r, $towns);

        if ($r->query('sort') != null){
            if (str_contains($r->query('sort'), ',')){
                $sortThis = explode(',', $r->query('sort'));
            }
            else{
                $sortThis = [$r->query('sort')];
            }

            foreach ($sortThis as $key => $value) {
                $field = $value;
                $sortAsc = true;

                if (str_contains($field, ':')){
                    $field = explode(':', $field)[0];

                    if (explode(':', $field)[1] == 'desc'){
                        $sortAsc = false;
                    }
                }

                if ($sortAsc) {
                     $towns = $towns->sortBy($field);
                }
                else {
                    $towns = $towns->sortByDesc($field);
                }
            }
        }

        return $towns;
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
    public function store(TownCreationRequest $request, $Users_UID)
    {
        $request->validated();

        Town::create([
            'TownName' => $request->TownName,
            'XCords' => random_int(-200, 200),
            'YCords' => random_int(-200, 200),
            'Users_UID' => $Users_UID
        ]);

        return ('pog');
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
