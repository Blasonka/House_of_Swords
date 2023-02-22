<?php

namespace App\Http\Controllers;

use App\Models\Bugreport;
use Illuminate\Http\Request;

class BugReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        // folyamazban
        // try {
        //     if (Bugreport::find($id)->exists()) {
        //         $user = Bugreport::find($id);
        //         $user->update($request->all());
        //         return response()->json(['message' => 'Item was updated, id: ' . $id], 200);
        //     } else {
        //         return response()->json(['message' => 'Item not found, id: ' . $id], 404);
        //     }
        // } catch (Exception $e) {
        //     return response()->json(['message' => 'Database error'], 400);
        // }
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
}
