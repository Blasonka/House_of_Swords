<?php

namespace App\Http\Controllers\BuildingControllers;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Buildings\Barrack;
use App\Models\Town;
use Illuminate\Http\Request;
use Exception;

class BarrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Barrack::all();
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
        return Barrack::find($id);
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

    public function showTrainedUnits($id){
        try {
            return Town::find($id)->trainedUnits()
            ->join('units', 'trained_units.UnitID', '=', 'units.UnitID')
            ->select('UnitAmount','units.*')->get();
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    public function startTraining(Request $request){
        try {
            $barrack = Building::find($request->BuildingID);

            if ($barrack->BuildingType != "Barrack") {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Barrack.'
                ], 400);
            }

            if($request->usingResource=='gold'){
                $town = $barrack->town;
                $town->Gold -= $request->ResourceAmount;
                if($town->Gold>=0){
                    $town->save();
                    return response()->json($town, 200);
                }
            }
            else if($request->usingResource=='fallen'){
                $infirmary = Building::where([
                    ['BuildingType','like','Infirmary'],
                    ['Towns_TownID','=',$barrack->Towns_TownID]
                ])->get()[0];
                $infirmary->healedUnits -= $request->ResourceAmount;
                if($infirmary->healedUnits>=0){
                    $infirmary->save();
                    return response()->json($infirmary, 200);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid input, you must have enough of the required resources.'
            ], 400);

        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }
}
