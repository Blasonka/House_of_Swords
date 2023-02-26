<?php

namespace App\Http\Controllers\BuildingControllers;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Buildings\Warehouse;
use Exception;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Warehouse::all();
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
        return Warehouse::find($id);
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

    public function AddBrigade(Request $request){
        try {
            $warehouse = Building::find($request->BuildingID);

            if ($warehouse->BuildingType != "Warehouse") {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested building is not of type Warehouse.'
                ], 400);
            }

            if($request->has('addStone')){
                $warehouse->BrigadeInStone += $request->addStone;
                $warehouse->save();
                return response()->json($warehouse, 200);
            }

            if($request->has('addWood')){
                $warehouse->BrigadeInWood += $request->addWood;
                $warehouse->save();
                return response()->json($warehouse, 200);
            }

            if($request->has('addMetal')){
                $warehouse->BrigadeInMetal += $request->addMetal;
                $warehouse->save();
                return response()->json($warehouse, 200);
            }

            if($request->has('addGold')){
                $warehouse->BrigadeInGold += $request->addGold;
                $warehouse->save();
                return response()->json($warehouse, 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid input, the request must contain one of the following fields: addStone, addWood, addMetal or addGold'
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
