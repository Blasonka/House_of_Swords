<?php

namespace App\Http\Controllers\BuildingControllers;

use App\Http\Controllers\Controller;
use App\Models\Buildings\Diplomacy;
use App\Models\Friendlist;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;


class DiplomacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Diplomacy::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Diplomacy::find($id);
    }

    public function showFriends($id){
        try {
            $b=User::find($id)->yourFriendRequests;
            $friend = [];
            foreach ($b as $value) {
                $c=Friendlist::where([
                    ['FriendID','like',$id],
                    ['Users_UID','like',$value->UID]
                    ])->get();
                if(count($c)>0){
                    array_push($friend, $c[0]);
                }
            }
            return $friend; //csak a kölcsönös kapcsolatok
            // return User::find($id)->friendRequestForYou;
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

}
