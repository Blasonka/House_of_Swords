<?php

use App\Http\Controllers\BugReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
Route::get('/bugreport',[PageController::class, 'bugReport'])->name('bugReport');

Route::get('/downloadWindows', function () {
    return response()->download(storage_path('/app/public/download/House of Swords v0.04 PC.rar'));
});

Route::get('/downloadAndroid', function () {
    return response()->download(storage_path('/app/public/download/House of Swords v0.04 Android.apk'));
});

Route::prefix('/cards')->group(function () {
    Route::get('/developers', function() {
        return view('home.introduction');
    });
});

Route::patch('/admin/bugreports/{Id}', [BugReportController::class, 'updateOnWebsite']);

// Bejelentkezés nélkül igen, de bejelentkezve nem látszik
Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', [PageController::class, 'register'])->name('register.show');
    Route::post('/register', [UserController::class, 'store'])->name('register.register');

    Route::get('/login', [PageController::class, 'loginshow'])->name('login.show');
    Route::post('/login',[PageController::class, 'login'])->name('login.login');

    Route::get('/forgottenpw', [PageController::class, 'forgottenpw'])->name('forgottenpw');
    Route::post('/resetpw', [MailController::class, 'resetpw'])->name('resetpw');
    Route::get('/resetpw/{token}', [PageController::class, 'resetpw'])->name('resetpw');
    Route::put('/resetpw', [PageController::class, 'newpw'])->name('newpw');
});


// Bejelentkezve, látszik
Route::group(['middleware' => ['auth']], function (){
    Route::get('/logout',[PageController::class, 'logout'])->name('logout');
});

// Bejelentkezve, de nem hitelesített email cimmel látszik
Route::group(['middleware' => ['auth', 'notverified.email']], function (){
    Route::get('/verify',[PageController::class, 'verify'])->name('verify');
});


// Csak bejelentkezve látszanak (sima user joggal)
Route::group(['middleware' => ['auth', 'verified.email']], function (){
    Route::get('/profil', [PageController::class, 'profil'])->name('user.profil');
    Route::patch('/profil/{UID}', [PageController::class, 'profilUpdate'])->name('user.profilUpdate');

    Route::patch('/save-image/{UID}', [PageController::class, 'saveImage'])->name('save-image');

});


// Csak bejelentkezve látszanak (admin joggal)
Route::group(['middleware' => ['auth', 'verified.email', 'admin']], function (){
    Route::get('/admin', [PageController::class, 'admin'])->name('admin');
});


// Csak bejelentkezve látszanak (owner joggal)
Route::group(['middleware' => ['auth', 'verified.email', 'owner']], function (){
    Route::get('/owner', [PageController::class, 'owner'])->name('owner');
});


// Emailek routingja (csak tesztnek van, később ki lesz szedve)
Route::get('/send', [MailController::class, 'index']);
Route::post('/send', [MailController::class, 'mail']);
Route::get('/verify/{token}', [MailController::class, 'emailVerification'])->name('emailVerification');
Route::post('/bugreport',[MailController::class, 'bugReportMail'])->name('bugReportMail');
Route::post('/verifyresend',[MailController::class, 'verifyResend'])->name('verifyResend');



// 404 hiba kezelés
Route::any('{params}', [PageController::class, 'notFound'])->name('notFound');

