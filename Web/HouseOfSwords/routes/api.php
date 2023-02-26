<?php

use App\Http\Controllers\BugReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\FriendlistController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingControllers\ChurchController;
use App\Http\Controllers\BuildingControllers\ResearchController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BuildingControllers\InfirmaryController;
use App\Http\Controllers\BuildingControllers\WarehouseController;

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
Route::get('/', function () {
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


// BUGREPORT STATUS
Route::apiResource('bugreports', BugReportController::class);


// TOWNS
Route::apiResource('towns', TownController::class);
Route::get('/users/{UID}/towns', [TownController::class, 'showSpecial']);


// BUILDINGS
Route::apiResource('buildings', BuildingController::class);
Route::get('/towns/{Town_ID}/buildings', [BuildingController::class, 'showSpecial']);


// STATS
Route::apiResource('stats/units', UnitController::class);
Route::apiResource('stats/church', ChurchController::class);
Route::apiResource('stats/infirmary', InfirmaryController::class);
Route::apiResource('stats/research', ResearchController::class);
Route::apiResource('stats/warehouse', WarehouseController::class);

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

    // INFIRMARY ACTIONS
    Route::prefix('infirmary')->group(function () {
        Route::post('startCure', [InfirmaryController::class, 'StartCure']);
        Route::post('finishCure', [InfirmaryController::class, 'FinishCure']);
    });

    // WAREHOUSE ACTIONS
    Route::prefix('warehouse')->group(function () {
        Route::post('addbrigade', [WarehouseController::class, 'AddBrigade']);
    });

    // OTHER BUILDINGS' ACTIONS
    // ...
});

// FRIENDLIST
Route::apiResource('friendlists', FriendlistController::class);


// ANY UNKNOWN METHODS
Route::any('{params}', function ($params) {
    return 'Error 404: Requested content does not exist → ' . $params . '.';
});
