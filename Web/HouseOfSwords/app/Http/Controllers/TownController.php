<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Http\Requests\TownRequests\TownCreationRequest as CreationRequest;
use App\Http\Requests\TownRequests\TownPatchRequest as PatchRequest;
use App\Models\Building;

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
    public function store(CreationRequest $request)
    {
        $town = Town::create([
            'TownName' => $request->TownName,
            'XCords' => random_int(-200, 200),
            'YCords' => random_int(-200, 200),
            'Users_UID' => $request->Users_UID
        ]);

        return Town::find($town->TownID);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $town = Town::find($id);

        if($town) { return $town; }
        else { return response()->json([ 'Error, bad id: '.$id ], 404); }
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
    public function update(PatchRequest $request, $id)
    {
        $town = Town::find($id);
        $town->update($request->all());
        return $town;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $town = Town::find($id);

        if($town) {
            Building::where('Towns_TownID', $id)->delete();
            $town->delete();
            return response()->json([ 'Town and their buildings has been deleted' ], 200);
        }
        else {
            return response()->json([ 'Error, bad id: '.$id ], 404);
        }
    }
}
