<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequests\BuildingPatchRequest;
use App\Http\Requests\BuildingRequests\BuildingCreationRequest;
use App\Models\Building;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class BuildingController extends Controller
{
    private $buildingFields = [
        'Towns_TownID',
        'BuildingType',
        'BuildingLvl',
        'Params'
    ];

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
    public function store(BuildingCreationRequest $request)
    {
        $request->validated();

        $building = new Building();

        foreach ($this->buildingFields as $key => $value) {
            $building->$value = $request->$value;
        }

        $building->save();
        return $building;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Building::find($id);
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
    public function update(BuildingPatchRequest $request, $id)
    {
        $building = Building::find($id);
        $building->update($request->all());
        return $building;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Building::destroy($id);
        return `Building no. $id destroyed.`;
    }
}
