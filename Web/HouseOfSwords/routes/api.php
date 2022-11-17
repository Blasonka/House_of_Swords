<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TownController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(){
    return [
        'creator' => 'Wauboi',
        'whatIsThis' => 'An API',
        'whatDoesItStandFor' => 'Application Programming Interface',
        'isItWorking' => 'Yes',
        'isItCool' => 'HELL YES'
    ];
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{params}', [UserController::class, 'show']);

Route::get('/towns', [TownController::class, 'index']);
Route::get('/towns/{id}', [TownController::class, 'show']);

Route::any('{params}', function ($params) {
    return 'Error 404: Requested content does not exist → '.$params.'.';
});
