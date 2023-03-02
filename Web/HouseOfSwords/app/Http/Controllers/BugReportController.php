<?php

namespace App\Http\Controllers;

use App\Models\Bugreport;
use Exception;
use Illuminate\Http\Request;

class BugReportController extends Controller
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
        try {
            if (Bugreport::find($id)->exists()) {
                $bugreport = Bugreport::find($id);
                $bugreport->update($request->all());
                return redirect()->back();
                // return response()->json(['message' => 'Item was updated, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'Item not found, id: ' . $id], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Database error'], 400);
        }
    }

    public function updateOnWebsite(Request $request, $id)
    {
        try {
            if (Bugreport::find($id)->exists()) {
                $bugreport = Bugreport::find($id);
                $bugreport->update($request->all());
                return redirect()->back();
                // return response()->json(['message' => 'Item was updated, id: ' . $id], 200);
            } else {
                return redirect()->back()->withErrors([
                    'message' => 'Item not found.'
                ]);
            }
        } catch (Exception $e) {
            return response()->back()->withErrors([
                'message' => 'Database error.'
            ]);
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
        //
    }
}
