<?php

namespace App\Http\Controllers\BuildingControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Buildings\Church;
use App\Models\Town;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Exception;

use function PHPSTORM_META\type;

class ChurchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Church::all();
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
        return Church::find($id);
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
        Church::destroy($id);
        return response()->json([ 'success' => true ], 200);
    }

    // EGY ISTENTISZTELET INDÍTÁSA
    public function startMass(Request $request)
    {
        try {
            $church = Building::find($request->BuildingID);

            if ($church->BuildingType != 'Church'){
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Church.'
                ], 400);
            }

            $churchStats = Church::find($church->BuildingLvl);

            $church->lastMassDate = Carbon::now();
            // $params = json_decode($church->Params);

            // // CHECK IF ENOUGH TIME HAS PASSED SINCE LAST MASS
            // // $massLengthUnix = $churchStats->MassLength;
            // // $currentDateUnix = date_create()->format('Y-m-d H:i:s');
            // // $lastMassDateUnix = $params->lastMassDate;

            // // return response()->json($lastMassDateUnix);

            // $params->lastMassDate = date('Y-m-d H:i:s');
            // $church->Params = json_encode($params);
            $church->save();

            $town = Town::find($church->Towns_TownID);
            $town->HappinessValue += $churchStats->HappinessBoost;
            $town->save();

            return response()->json($church, 200);
        }
        catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }
}
