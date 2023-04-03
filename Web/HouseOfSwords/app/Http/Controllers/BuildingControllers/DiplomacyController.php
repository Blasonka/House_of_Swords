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

    public function showFriends($UID){
        try {
            $friendsList = [];

            $friends = Friendlist::where([['isConfirmed','=',true],['Users_UID','=',$UID]])->get();
            if(count($friends)>0){
                foreach ($friends as $friend) {
                    $friend->FriendUser->RelationID=$friend->RelationID;
                    array_push($friendsList, $friend->FriendUser);
                }
            }

            $friends=Friendlist::where([['isConfirmed','=',true],['FriendID','=',$UID]])->get();
            if(count($friends)>0){
                foreach ($friends as $friend) {
                    $friend->User->RelationID=$friend->RelationID;
                    array_push($friendsList, $friend->User);
                }
            }


            return response()->json($friendsList,200); //csak a kölcsönös kapcsolatok
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

    public function showFriendRequests($UID){
        try {
            $friendRequestsList = [];
            $requests=Friendlist::where([['isConfirmed','=',false],['FriendID','=',$UID]])->get();
            if(count($requests)>0){
                foreach ($requests as $request) {
                    $request->User->RelationID=$request->RelationID;
                    array_push($friendRequestsList, $request->User);
                }
            }

            return response()->json($friendRequestsList,200); //csak a viszonzatlan kapcsolatok
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'An unknown server error has occured.',
                'details' => $err->getMessage()
            ], 500);
        }
    }

}
