<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Town;
use App\Http\Requests\TownRequests\TownCreationRequest as CreationRequest;
use App\Http\Requests\TownRequests\TownPatchRequest as PatchRequest;
use App\Models\Building;
use App\Models\SiegeSystem\TrainedUnit;
use App\Models\User;
use Carbon\Carbon;
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
            // CREATE TOWN
            $town = Town::create([
                'TownName' => $request->TownName,
                'XCords' => random_int(-1000, 1000),
                'YCords' => random_int(-1000, 1000),
                'Users_UID' => $request->Users_UID
            ]);

            // CREATE BUILDINGS FOR TOWN
            $defaultDate = Carbon::create(2000, 1, 1, 0, 0, 0);

            foreach (Building::$typeClass as $buildingType => $buildingClass) {
                $params = [
                    'Towns_TownID' => $town->TownID,
                    'BuildingType' => $buildingType
                ];

                switch ($buildingType) {
                    case 'Barrack':
                        // ...
                        break;
                    case 'Church':
                        $params['lastMassDate'] = $defaultDate;
                        break;
                    case 'Diplomacy':
                        // ...
                        break;
                    case 'Infirmary':
                        $params['lastCureDate'] = $defaultDate;
                        $params['currentCure'] = 0;
                        $params['injuredUnits'] = 0;
                        $params['healedUnits'] = 0;
                        break;
                    case 'Market':
                        // ...
                        break;
                    case 'Research':
                        $params['currentScience'] = 0;
                        $params['storedScience'] = 0;
                        break;
                    case 'Warehouse':
                        $params['BrigadeInWood'] = 0;
                        $params['BrigadeInStone'] = 0;
                        $params['BrigadeInMetal'] = 0;
                        $params['BrigadeInGold'] = 0;
                        $params['BrigadeInWarehouse'] = 4;
                        break;
                    default:
                        break;
                }

                Building::create($params);
            }

            // CREATE TRAINED UNIT RECORD FOR SWORDSMAN
            TrainedUnit::create([
                'TownID' => $town->TownID,
                'UnitID' => 1,
                'UnitAmount' => 0
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
            // $towns = [];

            // foreach (Town::all()->where('Users_UID', '=', $UID)->toArray() as $key => $value) {
            //     array_push($towns, $value);
            // }

            // return response()->json($towns, 200);

            return response()->json(User::find($UID)->towns, 200);
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
