<?php

namespace App\Http\Controllers\BuildingControllers;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Buildings\Research;
use App\Models\ResearchedUnit;
use App\Models\Unit;
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
        try {
            return Research::all();
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
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
        try {
            $stat = Research::find($id);

            if ($stat == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested stat does not exist.'
                ], 400);
            }

            return response()->json($stat, 200);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    public function showUntilLevel($lvl){
        try {
            $stats = Research::all()->where('Lvl', '<=', $lvl);

            if ($stats == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested stats do not exist.'
                ], 400);
            }

            if (sizeof($stats) < $lvl || sizeof($stats) < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested stats do not all exist.'
                ], 400);
            }

            return response()->json($stats, 200);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'success' => false,
            'message' => 'You are not permitted to invoke this action.'
        ], 401);
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
        return response()->json([
            'success' => false,
            'message' => 'You are not permitted to invoke this action.'
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'success' => false,
            'message' => 'You are not permitted to invoke this action.'
        ], 401);
    }

    // ACTIONS
    public function collectScience(Request $request){
        try {
            $building = Building::find($request->BuildingID);

            if ($building == null)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building does not exist.'
                ], 400);
            }

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
                'message' => 'An unknown error has occured.',
                'details' => $err->getMessage()
            ], 400);
        }
    }

    public function researchUnit(Request $request){
        try {
            if (Unit::find($request->input('UnitID')) == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested unit does not exist.'
                ], 400);
            }

            $researchBuilding = Building::find($request->input('ResearchBuildingID'));
            if ($researchBuilding == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested research building does not exist.'
                ], 400);
            }
            if ($researchBuilding->BuildingType != 'Research') {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Research.'
                ], 400);
            }

            $researchedUnit = new ResearchedUnit([
                'ResearchBuildingID' => $request->input('ResearchBuildingID'),
                'UnitID' => $request->input('UnitID')
            ]);
            $researchedUnit->save();

            return response()->json($researchedUnit, 200);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }
}
