<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

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
// Auth::routes(['verify' => true]);


// Mindig látszik
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/download', [PageController::class, 'download'])->name('download');
Route::get('/verify',[PageController::class, 'verify'])->name('verify');


// Bejelentkezés nélkül igen, de bejelentkezve nem látszik
Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', [PageController::class, 'register'])->name('register.show');
    Route::post('/register', [UserController::class, 'store'])->name('register.register');
    Route::get('/login', [PageController::class, 'loginshow'])->name('login.show');
    Route::post('/login',[PageController::class, 'login'])->name('login.login');
});


Route::group(['middleware' => ['auth']], function (){
    //
});

// Csak bejelentkezve látszanak (sima user joggal)
Route::group(['middleware' => ['auth', 'verified.email']], function (){
    Route::get('/', [PageController::class, 'index'])->name('index');
    Route::get('/logout',[PageController::class, 'logout'])->name('logout');
    Route::get('/profil', [PageController::class, 'profil'])->name('user.profil');
});


// Csak bejelentkezve látszanak (admin joggal)
Route::group(['middleware' => ['auth', 'admin']], function (){
    Route::get('/admin', [PageController::class, 'admin'])->name('admin');
});


// Csak bejelentkezve látszanak (owner joggal)
Route::group(['middleware' => ['auth', 'owner']], function (){
    Route::get('/owner', [PageController::class, 'owner'])->name('owner');
});


// Emailek routingja (csak tesztnek van, később ki lesz szedve)
Route::get('/send', [MailController::class, 'index']);
Route::post('/send', [MailController::class, 'mail']);
Route::get('/verify/{token}', [MailController::class, 'emailVerification'])->name('emailVerification');


// 404 hiba kezelés
Route::any('{params}', [PageController::class, 'notFound']);

