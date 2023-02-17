<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json(Unit::all(), 200);
        }
        catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown error has occured.',
                'details' => $err->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'success' => false,
            'message' => 'You are not authorized to commit this action.'
        ], 401);
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
            $unit = Unit::find($id);

            if ($unit == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested unit does not exist.'
                ], 400);
            }

            return response()->json(Unit::all(), 200);
        }
        catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
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
            'message' => 'You are not authorized to commit this action.'
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
            'message' => 'You are not authorized to commit this action.'
        ], 401);
    }
}
