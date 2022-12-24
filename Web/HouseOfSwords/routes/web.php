<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//mindig látszik
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about', [PageController::class, 'about'])->name('about');


//bejelentkezés nélkül igen, de bejelentkezve nem látszik
Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', [PageController::class, 'register'])->name('register.show');
    Route::post('/register', [UserController::class, 'store'])->name('register.register');
    Route::get('/login', [PageController::class, 'loginshow'])->name('login.show');
    Route::post('/login',[PageController::class, 'login'])->name('login.login');
});

//Teszt adatok: Username:TesztLoginhoz pwd:Login123$
//Hiba: a pwd-k nem egyeznek

//védett oldalak (belépés után látszik csak)
//nincs benne a groupba, mert még nem jó a login
Route::get('/profil', [PageController::class, 'profil'])->name('user.profil');
Route::group(['middleware' => ['auth']], function (){

});


//védett oldalak (user jogtól függ) - (admin oldalak)
//

// 404 hiba kezelés
Route::any('{params}', [PageController::class, 'notFound']);
