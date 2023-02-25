<?php

namespace App\Http\Controllers\BuildingControllers;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Buildings\Infirmary;
use Exception;
use Illuminate\Http\Request;

class InfirmaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Infirmary::all();
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
        return Infirmary::find($id);
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

    // EGY GYÓGYÍTÁS INDÍTÁSA
    public function StartCure(Request $request)
    {
        try {
            $infirmary = Building::find($request->BuildingID);

            if ($infirmary->BuildingType != "Infirmary") {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Infirmary.'
                ], 400);
            }

            if ($infirmary->injuredUnits == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'To start cure you must have injured units.'
                ], 400);
            }

            $infirmary->lastCureDate = date('Y-m-d H:i:s');
            $infirmary->currentCure = $infirmary->injuredUnits;
            $infirmary->injuredUnits = 0;
            $infirmary->save();
            return response()->json($infirmary, 200);

        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    // EGY GYÓGYÍTÁS UTÁN A KATONÁKBEGYŰJTÉSE
    public function FinishCure(Request $request)
    {
        try {
            $infirmary = Building::find($request->BuildingID);

            if ($infirmary->BuildingType != "Infirmary") {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Infirmary.'
                ], 400);
            }

            $infirmaryStats = Infirmary::find($infirmary->BuildingLvl);

            //sikeresen meggyógyított unit-ok (gyógyított*effectivity(%))/100 lefelé kerektítve
            $newHealedUnits = floor(($infirmary->currentCure * $infirmaryStats->Effectivity) / 100);

            //healedUnits hozzáadása (figyelembe véve, hogy ne legyen több a maximum megengedettnél)
            if ($infirmaryStats->MaxHealedUnits <= ($infirmary->healedUnits + $newHealedUnits)) {
                $infirmary->healedUnits = $infirmaryStats->MaxHealedUnits;
            } else {
                $infirmary->healedUnits += $newHealedUnits;
            }

            $infirmary->currentCure = 0;
            $infirmary->save();
            return response()->json($infirmary, 200);

        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }
}
