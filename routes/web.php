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



    Route::get('/header',Header::class)->name('header');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/observation', \App\Http\Controllers\Observation\IndexController::class)->name('observation');
Route::get('/',  function () {
    return view('welcome');
})->name('welcome');

Route::get('observations',\App\Http\Controllers\Observation\IndexController::class)->name('observation.index');
Route::get('observations/create',\App\Http\Controllers\Observation\CreateController::class)->name('observation.create');
Route::post('observations',\App\Http\Controllers\Observation\StoreController::class)->name('observation.store');

