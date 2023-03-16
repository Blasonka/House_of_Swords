<?php

namespace App\Http\Controllers\BuildingControllers;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Buildings\Barrack;
use App\Models\SiegeSystem\Siege;
use App\Models\SiegeSystem\SiegingUnits;
use App\Models\SiegeSystem\TrainedUnit;
use App\Models\Town;
use App\Models\Unit;
use DateTime;
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

    public function showTrainedUnits($id)
    {
        try {
            return Town::find($id)->trainedUnits()
                ->join('units', 'trained_units.UnitID', '=', 'units.UnitID')
                ->select('UnitAmount', 'units.*')->get();
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    public function startTraining(Request $request)
    {
        try {
            $barrack = Building::find($request->BuildingID);

            if ($barrack->BuildingType != "Barrack") {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Barrack.'
                ], 400);
            }

            $unitStats = Unit::find($request->selectedUnitID);

            if ($request->usingResource == 'gold') {
                $town = $barrack->town;
                $town->Gold -= $request->ResourceAmount * $unitStats->TrainingCostGold;
                if ($town->Gold >= 0) {
                    $town->save();
                    $barrack->LastTrainingDate = date('Y-m-d H:i:s');
                    $barrack->TrainedUnitID = $request->selectedUnitID;
                    $barrack->TrainedAmount = $request->ResourceAmount;
                    $barrack->save();
                    return response()->json($barrack, 200);
                }
            } else if ($request->usingResource == 'fallen') {
                $infirmary = Building::where([
                    ['BuildingType', 'like', 'Infirmary'],
                    ['Towns_TownID', '=', $barrack->Towns_TownID]
                ])->get()[0];
                $infirmary->healedUnits -= $request->ResourceAmount * $unitStats->TrainingCostFallen;
                if ($infirmary->healedUnits >= 0) {
                    $infirmary->save();
                    $barrack->healedUnits = $infirmary->healedUnits;
                    $barrack->LastTrainingDate = date('Y-m-d H:i:s');
                    $barrack->TrainedUnitID = $request->selectedUnitID;
                    $barrack->TrainedAmount = $request->ResourceAmount;
                    $barrack->save();
                    return response()->json($barrack, 200);
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

    public function finishTraining(Request $request)
    {
        try {
            $barrack = Building::find($request->BuildingID);

            if ($barrack->BuildingType != "Barrack") {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Barrack.'
                ], 400);
            }

            if ($barrack->TrainedAmount < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'The trainedAmount must be greater than 0.'
                ], 400);
            }
            // $unitstats = Unit::find($request->selectedUnitID);
            $trainedUnit = TrainedUnit::where([
                ['TownID', '=', $barrack->Towns_TownID],
                ['UnitID', '=', $barrack->TrainedUnitID]
            ])->get()[0];
            // return response()->json($trainedUnit, 200);

            $trainedUnit->UnitAmount += $barrack->TrainedAmount;
            $trainedUnit->save();

            $barrack->TrainedUnitID = 0;
            $barrack->TrainedAmount = 0;
            $barrack->save();

            return response()->json($barrack, 200);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    public function startSiege(Request $request)
    {
        try {
            $siege = Siege::create([
                "AttackerTownID" => $request->AttackerTownID,
                "DefenderTownID" => $request->DefenderTownID,
                "SiegeTime" => $request->SiegeTime,
                "LootPercentage" => $request->LootPercentage
            ]);

            foreach ($request->Units as $unit) {
                SiegingUnits::create([
                    "SiegeID" => $siege->SiegeID,
                    "UnitID" => $unit['UnitID'],
                    "UnitAmount" => $unit['UnitAmount']
                ]);
            }

            return response()->json($siege, 200);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    public function FinishSiege(Request $request)
    {
        try {
            $siege = Siege::find($request->SiegeID);

            if ($siege->SiegeTime > date('Y-m-d H:i:s') || $siege->AttackerWon != null) {
                return response()->json([
                    'success' => false,
                    'message' => 'This siege cannot end, it has already ended or it is still going on.'
                ], 400);
            }

            $attacForce = 0;
            foreach ($siege->attackerUnits as $unit) {
                $attacForce += $unit['UnitAmount'] * $unit->unitType->AttackValue;
            }

            $defensiveForce = 0;
            foreach ($siege->defender->trainedUnits as $unit) {
                $defensiveForce += $unit['UnitAmount'] * $unit->unitType->DefenseValue;
            }

            if ($attacForce > $defensiveForce) {
                $siege->AttackerWon = true;
                // attackers loot
                $siege->attacker->Wood += $siege->defender->Wood * ($siege->LootPercentage * 0.01);
                $siege->attacker->Stone += $siege->defender->Stone * ($siege->LootPercentage * 0.01);
                $siege->attacker->Metal += $siege->defender->Metal * ($siege->LootPercentage * 0.01);
                $siege->attacker->Gold += $siege->defender->Gold * ($siege->LootPercentage * 0.01);
                // defenders lost
                $siege->defender->Wood = $siege->defender->Wood * (1 - ($siege->LootPercentage * 0.01));
                $siege->defender->Stone = $siege->defender->Stone * (1 - ($siege->LootPercentage * 0.01));
                $siege->defender->Metal = $siege->defender->Metal * (1 - ($siege->LootPercentage * 0.01));
                $siege->defender->Gold = $siege->defender->Gold * (1 - ($siege->LootPercentage * 0.01));
            } else {
                $siege->AttackerWon = false;
                // defenders loot
                $siege->defender->Wood += $siege->attacker->Wood * ($siege->LootPercentage * 0.01);
                $siege->defender->Stone += $siege->attacker->Stone * ($siege->LootPercentage * 0.01);
                $siege->defender->Metal += $siege->attacker->Metal * ($siege->LootPercentage * 0.01);
                $siege->defender->Gold += $siege->attacker->Gold * ($siege->LootPercentage * 0.01);
                // attackers lost
                $siege->attacker->Wood = $siege->attacker->Wood * (1 - ($siege->LootPercentage * 0.01));
                $siege->attacker->Stone = $siege->attacker->Stone * (1 - ($siege->LootPercentage * 0.01));
                $siege->attacker->Metal = $siege->attacker->Metal * (1 - ($siege->LootPercentage * 0.01));
                $siege->attacker->Gold = $siege->attacker->Gold * (1 - ($siege->LootPercentage * 0.01));
            }

            $siege->save();
            $siege->attacker->save();
            $siege->defender->save();
            return response()->json([
                'siege' => $siege
            ], 200);


            return response()->json($siege, 200);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }
}
