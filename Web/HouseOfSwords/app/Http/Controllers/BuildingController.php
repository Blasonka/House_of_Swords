<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Http\Requests\BuildingRequests\BuildingPatchRequest as PatchRequest;
use App\Http\Requests\BuildingRequests\BuildingCreationRequest as CreationRequest;
use Exception;

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
        try {
            return Building::create($request->all());
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
            $building = Building::find($id);
            if (!empty($building)) {
                return response()->json($building);
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
     * Display the specified resource that belongs to the given Town.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSpecial($Town_ID)
    {
        try {
            return Building::all()->where('Towns_TownID', '=', $Town_ID)->values();
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
            if (Building::find($id)->exists()) {
                $building = Building::find($id);
                $building->update($request->all());
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
            if (Building::find($id)->exists()) {
                Building::find($id)->delete();
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
