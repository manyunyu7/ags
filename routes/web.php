<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SummerNoteController;


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

Route::get('/landing', function () {
    return view('index');
})->name('landing');


Route::view('/ryy', '168_template');


Route::view('/', 'init');

Route::view('/template/home', 'template');
Route::view('/download/', 'download');

Auth::routes();

Route::get("fcm","ColekController@fcm");


Route::get('/bdm', 'ColekController@bdm');
Route::post('/proceedRegis', 'CustomAuthController@register');
Route::post('/proceedLogin', 'Auth\LoginController@proceedLogin');

Route::get('/artisan/dropDonasi', 'ArtisanController@dropDonasi');
Route::get('/artisan/drop', 'ArtisanController@drop');

Route::get('/drop/{schemeName}', 'ColekController@drop');




Route::post('/register', 'StaffController@store');
Route::group(['middleware' => ['auth']], function () {

    Route::prefix("learn")->group(function(){
        Route::view('pengenalan-dan-rekayasa', 'learn.01');
//        Route::view('evaluasi-pengenalan-komponen', 'learn.02');
//        Route::view('rekayasa-pengalaman', 'learn.03');
        Route::view('estimasi-biaya', 'learn.04');
        Route::get('/evaluasi-driving-parameter', [App\Http\Controllers\HomeController::class, 'eval']);
        Route::get('/evaluasi-final', [App\Http\Controllers\HomeController::class, 'evalFinal']);
        Route::get('/grafik-pengembangan', [App\Http\Controllers\HomeController::class, 'evalResult']);
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/main', [App\Http\Controllers\HomeController::class, 'main']);

});

Route::get('/save-score', [App\Http\Controllers\SaveQuizController::class, 'store']);
Route::get('/get-scores', [App\Http\Controllers\SaveQuizController::class, 'getScores']);

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');



