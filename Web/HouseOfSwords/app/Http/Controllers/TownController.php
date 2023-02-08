<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Http\Requests\TownRequests\TownCreationRequest as CreationRequest;
use App\Http\Requests\TownRequests\TownPatchRequest as PatchRequest;
use App\Models\Building;
use Exception;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Town::all();
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
            $town = Town::create([
                'TownName' => $request->TownName,
                'XCords' => random_int(-200, 200),
                'YCords' => random_int(-200, 200),
                'Users_UID' => $request->Users_UID
            ]);

            return Town::find($town->TownID);
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
            $town = Town::find($id);
            if (!empty($town)) {
                return response()->json($town);
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
    public function showSpecial($UID)
    {
        try { 
            return response()->json(Town::all()->where('Users_UID', '=', $UID));
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
            if (Town::find($id)->exists()) {
                $town = Town::find($id);
                $town->update($request->all());
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
