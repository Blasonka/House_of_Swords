<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequests\BuildingPatchRequest as PatchRequest;
use App\Http\Requests\BuildingRequests\BuildingCreationRequest as CreationRequest;
use App\Models\Building;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Building::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreationRequest $request)
    {
        return Building::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $building = Building::find($id);

        if($building) { return $building; }
        else { return response()->json('Error, bad id: '.$id, 404); }
    }

    /**
     * Display the specified resource that belongs to the given Town.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSpecial($Town_ID)
    {
        return Building::all()->where('Towns_TownID', '=', $Town_ID)->toArray();
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
        return Building::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Building::destroy($id);
        // return `Building no. $id destroyed.`;


        $building = Building::findOrFail($id);
        $building->delete();
        return `Building no. $id destroyed.`;
    }
}
