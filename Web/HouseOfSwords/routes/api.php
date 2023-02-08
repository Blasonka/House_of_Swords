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
Route::apiResource('users', UserController::class);
Route::get('/users/username/{username}', [UserController::class, 'showByName']);


// TOWNS
Route::apiResource('towns', TownController::class);
Route::get('/users/{UID}/towns', [TownController::class, 'showSpecial']);


// BUILDINGS
Route::apiResource('buildings', BuildingController::class);
Route::get('/towns/{Town_ID}/buildings', [BuildingController::class, 'showSpecial']);


// FRIENDLIST
Route::apiResource('friendlists', FriendlistController::class);


// ANY UNKNOWN METHODS
Route::any('{params}', function ($params) {
    return 'Error 404: Requested content does not exist → '.$params.'.';
});
