<?php

use App\Http\Controllers\BugReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\FriendlistController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingControllers\ChurchController;
use App\Models\Bugreport;
use App\Models\Town;
use App\Models\User;
use App\Http\Controllers\BuildingControllers\ResearchController;
use App\Http\Controllers\UnitController;

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

Route::get('/test', function(){
    #region Testing implementations
    // USERS, TOWNS, BUGREPORTS AND THEIR RELATIONSHIPS
    // return User::find(1)->towns[0]->buildings[0]->levelStats;
    // return Bugreport::find(1)->user;
    // return User::find(1)->bugreports;
    // return User::find(1)->towns[0]->buildings[0]->levelStats;
    // return User::find(1)->get('PwdHash');

    #region SIEGES RELATIONSHIPS TESTS
    // // A town's incoming and outgoing attacks
    // return Town::find(1)->initiatedSieges;
    // return Town::find(2)->incomingSieges;

    // // Getting a siege's defender or attacker town
    // return Town::find(1)->initiatedSieges[0]->attacker;
    // return Town::find(1)->initiatedSieges[0]->defender;

    // // Getting the attacking units, their amounts and types
    // return Town::find(1)->initiatedSieges[0]->attackerUnits;
    // return Town::find(1)->initiatedSieges[0]->attackerUnits[0]->UnitAmount;
    // return Town::find(1)->initiatedSieges[0]->attackerUnits[0]->unitType;
    #endregion
    #endregion
});


// USERS
Route::apiResource('users', UserController::class);
Route::get('/users/username/{username}', [UserController::class, 'showByName']);


// BUGREPORT STATUS
Route::apiResource('bugreports', BugReportController::class);


// TOWNS
Route::apiResource('towns', TownController::class);
Route::get('/users/{UID}/towns', [TownController::class, 'showSpecial']);


// BUILDINGS
Route::apiResource('buildings', BuildingController::class);
Route::get('/towns/{Town_ID}/buildings', [BuildingController::class, 'showSpecial']);
Route::get('/buildings/{Building_ID}/levelstats', [BuildingController::class, 'showLevelStats']);


// STATS
Route::apiResource('stats/units', UnitController::class);
Route::apiResource('stats/church', ChurchController::class);

Route::apiResource('stats/research', ResearchController::class);
Route::get('stats/research/researchedUnits/{researchBuildingId}', [ResearchController::class, 'getResearchedUnits']);
// Route::get('stats/research/until/{lvl}', [ResearchController::class, 'showUntilLevel']);

// BUILDING ACTIONS
Route::prefix('actions')->group(function () {
    // CHURCH ACTIONS
    Route::prefix('church')->group(function () {
        Route::post('startMass', [ChurchController::class, 'startMass']);
    });

    // RESEARCH ACTIONS
    Route::prefix('research')->group(function () {
        Route::post('collectScience', [ResearchController::class, 'collectScience']);
        Route::post('researchUnit', [ResearchController::class, 'researchUnit']);
    });

    // OTHER BUILDINGS' ACTIONS
    // ...
});

// FRIENDLIST
Route::apiResource('friendlists', FriendlistController::class);


// ANY UNKNOWN METHODS
Route::any('{params}', function ($params) {
    return 'Error 404: Requested content does not exist → '.$params.'.';
});
