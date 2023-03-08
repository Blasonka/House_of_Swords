<?php

namespace App\Http\Controllers;

use App\Models\Town;
use Exception;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class SiegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return Town::all();
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
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
            $sieges = Town::find($id)->initiatedSieges()
            ->join('towns', 'towns.TownID', '=', 'sieges.AttackerTownID')
            ->select('sieges.*','TownName AS AttackerTown')->get();
            // array_push($sieges,Town::find($id)->incomingSieges()
            // ->join('towns', 'towns.TownID', '=', 'sieges.DefenderTownID')
            // ->select('sieges.*','TownName AS DefenderTown')->get());

            return $sieges;
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
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

    public function showInitiatedSieges($id)
    {
        try {
            return Town::find($id)->initiatedSieges()
            ->join('towns', 'towns.TownID', '=', 'sieges.DefenderTownID')
            ->select('sieges.*','TownName AS DefenderTown')->get();

        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    public function showincomingSieges($id)
    {
        try {
            return Town::find($id)->incomingSieges()
            ->join('towns', 'towns.TownID', '=', 'sieges.AttackerTownID')
            ->select('sieges.*','TownName AS AttackerTown')->get();

        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }
}
