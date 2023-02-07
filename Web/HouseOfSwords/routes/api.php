<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\FriendlistController;
use App\Http\Controllers\BuildingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//API működésének tesztje
Route::get('/', function(){
    return [
        'creator' => 'Wauboi',
        'whatIsThis' => 'An API',
        'whatDoesItStandFor' => 'Application Programming Interface',
        'isItWorking' => 'Yes',
        'isItCool' => 'HELL YES'
    ];
});


// USERS
Route::apiResource('user', UserController::class);


// TOWNS
Route::apiResource('town', TownController::class);
Route::get('/town/{Town_ID}/building', [BuildingController::class, 'showSpecial']);


// BUILDINGS
Route::apiResource('building', BuildingController::class);


// FRIENDLIST
Route::apiResource('friendlist', FriendlistController::class);


// ANY UNKNOWN METHODS
Route::any('{params}', function ($params) {
    return 'Error 404: Requested content does not exist → '.$params.'.';
});
