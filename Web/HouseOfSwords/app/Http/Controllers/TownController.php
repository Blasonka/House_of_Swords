<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Http\Requests\TownCreationRequest;
use App\Models\Building;

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

        // HA TÖBB MINT EGY TALÁLAT: TÖMBÖT ADJON VISSZA
        // HA CSAK EGY TALÁLAT: A KAPOTT INDEX-ÉRTÉK PÁRBÓL CSAK AZ ÉRTÉKET ADJA VISSZA
        // Ez egy furcsa "feature" miatt szükséges, ahol a tömbök Laravelben
        // automatikusan kulcs-érték párként jönnek létre, ahol a kulcs az érték indexe.
        $result = [];
        foreach ($towns as $key => $value) {
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
    public function destroy($Town_ID)
    {
        $town = Town::find($Town_ID);
        $buildings = Building::where('Towns_TownID', $Town_ID)->get();

        if($town && $buildings) {
            $town->delete();
            $buildings->delete();
            return response()->json([ 'Town and their buildings has been deleted' ], 200);
        }
        else {
            return response()->json([ 'Error, bas id: '.$Town_ID. 'or town has no buildings, pls contact the support' ], 404);
        }
    }
}
