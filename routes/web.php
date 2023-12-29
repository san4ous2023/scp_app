<?php

use App\Livewire\Header;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/',  function () {
//    return view('welcome');
//})->middleware('first_enter');

Auth::routes();
Route::group(['prefix'=>'/','middleware'=>'first_enter'],function (){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/header',Header::class)->name('header');

});

Route::get('/',  function () {
    return view('welcome');
});

