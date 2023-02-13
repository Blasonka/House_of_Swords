<?php

namespace App\Http\Controllers\BuildingControllers;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Buildings\Research;
use Exception;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Research::all();
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
        return Research::find($id);
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
        return Research::destroy($id);
    }

    public function collectScience(Request $request){
        try {
            $building = Building::find($request->BuildingID);

            if ($building->BuildingType != 'Research')
            {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Research.'
                ], 400);
            }

            $params = json_decode($building->Params);

            $params->storedScience += $params->currentScience;
            $params->currentScience = 0;

            $building->Params = json_encode($params);
            $building->save();

            return response()->json($building, 200);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error occured.',
                'details' => $err->getMessage()
            ], 400);
        }
    }
}
