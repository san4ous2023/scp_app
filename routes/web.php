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
//Route::get('/observation', \App\Http\Controllers\AdminObservation\IndexController::class)->name('observation');
Route::get('/',  function () {
    return view('welcome');
})->name('welcome');

Route::get('observations', \App\Http\Controllers\Observation\IndexController::class)->name('observation.index');
Route::get('observations/create', \App\Http\Controllers\Observation\CreateController::class);
Route::post('observations', \App\Http\Controllers\Observation\StoreController::class)->name('observation.store');
Route::get('observations/{observation}', \App\Http\Controllers\Observation\ShowController::class)->name('observation.show');
Route::get('observations/{observation}/edit', \App\Http\Controllers\Observation\EditController::class)->name('observation.edit');
Route::patch('observations/{observation}', \App\Http\Controllers\Observation\UpdateController::class)->name('observation.update');
Route::delete('observations/{observation}', \App\Http\Controllers\Observation\DestroyController::class)->name('observation.destroy');

//Route::get('observations',\App\Http\Controllers\Observation\IndexController::class)->name('observation.index');
//Route::get('observations/create',\App\Http\Controllers\Observation\CreateController::class)->name('observation.create');
//Route::post('observations',\App\Http\Controllers\Observation\StoreController::class)->name('observation.store');

//LiveWire
Route::get('observ/create',App\Livewire\Observation\Create::class)->name('observ.create1');
Route::post('observ/create',App\Livewire\Observation\Create::class)->name('observ.create1');

Route::prefix('admin')->group(function () {
    // Route::get('/', AdminController::class)->name('admin.index');
    Route::get('/observation', App\Livewire\Admin\AdminObservation::class)->name('admin.observation.index');
});

