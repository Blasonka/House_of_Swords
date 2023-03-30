<?php

use App\Http\Controllers\BugReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\FriendlistController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingControllers\BarrackController;
use App\Http\Controllers\BuildingControllers\ChurchController;
use App\Http\Controllers\BuildingControllers\DiplomacyController;
use App\Models\Bugreport;
use App\Models\Town;
use App\Models\User;
use App\Http\Controllers\BuildingControllers\ResearchController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BuildingControllers\InfirmaryController;
use App\Http\Middleware\GameSessionAuthentication;
use App\Http\Controllers\BuildingControllers\WarehouseController;
use App\Http\Controllers\SiegeController;
use App\Models\Building;
use App\Models\Buildings\Barrack;
use App\Models\Buildings\Infirmary;
use App\Models\SiegeSystem\TrainedUnit;
use App\Models\Unit;

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

// Hitelesség ellenőrzés / Bejelentkezés
Route::any('/gameSessionAuthFail', function () {
    return response()->json([
        'success' => false,
        'message' => 'You are not authorized to access this data.'
    ], 401);
})->name('gameSessionAuthFail');

Route::post('/createGameSession', [UserController::class, 'loginRequest']);
Route::post('/terminateGameSession', [UserController::class, 'logoutRequest']);

// API működésének tesztje
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
    $trainedunits = Town::find(1)->trainedUnits()
    ->join('units', 'trained_units.UnitID', '=', 'units.UnitID')
    ->select('UnitAmount','units.*')->get();

    return $trainedunits;
    // $town = Town::find(1);
    return response()->json([
        'units'=>$trainedunits
    ], 200);

    return Building::all();

    return response()->json('Test works!', 200);
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

Route::get('/buildings/{Building_ID}/currentScience', [BuildingController::class, 'showCurrentScience']);


// STATS
Route::prefix('stats')->group(function () {
    Route::apiResource('units', UnitController::class);
    Route::prefix('sieges')->group(function () {
        Route::get('initiated/{id}', [SiegeController::class, 'showInitiatedSieges']);
        Route::get('incoming/{id}',[SiegeController::class, 'showincomingSieges']);
    });

    //Buildings
    Route::apiResource('church', ChurchController::class);
    Route::apiResource('infirmary', InfirmaryController::class);
    Route::apiResource('research', ResearchController::class);
    Route::apiResource('warehouse', WarehouseController::class);
    Route::apiResource('barrack', BarrackController::class);
    Route::apiResource('diplomacy', DiplomacyController::class);

});

Route::get('stats/research/researchedUnits/{researchBuildingId}', [ResearchController::class, 'getResearchedUnits']);

// BUILDING ACTIONS
Route::prefix('actions')->group(function () {
    // BARRACK ACTIONS
    Route::prefix('barrack')->group(function () {
        Route::get('{Town_ID}/showtrainedunits', [BarrackController::class, 'showTrainedUnits']);
        Route::post('starttraining',[BarrackController::class, 'startTraining']);
        Route::post('finishtraining',[BarrackController::class, 'finishTraining']);
        Route::post('startsiege',[BarrackController::class, 'startSiege']);
        Route::post('finishsiege',[BarrackController::class, 'FinishSiege']);
    });
    // CHURCH ACTIONS
    Route::prefix('church')->group(function () {
        Route::post('startMass', [ChurchController::class, 'startMass']);
    });

    // RESEARCH ACTIONS
    Route::prefix('research')->group(function () {
        Route::post('collectScience', [ResearchController::class, 'collectScience']);
        Route::post('researchUnit', [ResearchController::class, 'researchUnit']);
    });

    // INFIRMARY ACTIONS
    Route::prefix('infirmary')->group(function () {
        Route::post('startCure', [InfirmaryController::class, 'StartCure']);
        Route::post('finishCure', [InfirmaryController::class, 'FinishCure']);
    });

    // WAREHOUSE ACTIONS
    Route::prefix('warehouse')->group(function () {
        Route::post('addbrigade', [WarehouseController::class, 'AddBrigade']);
        Route::post('removebrigade', [WarehouseController::class, 'RemoveBrigade']);
    });

    // OTHER BUILDINGS' ACTIONS
    // ...
});

// FRIENDLIST
Route::apiResource('friendlists', FriendlistController::class);


// ANY UNKNOWN METHODS
Route::any('{params}', function ($params) {
    return response()->json([
        'success' => false,
        'message' =>  'Error 404: Requested content does not exist → ' . $params . '.'
    ], 404);
});
