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

    Route::get('/',  function () {
        return view('welcome');
    })->name('welcome');

    //Route::get('/header',Header::class)->name('header');



});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'observations'], function() {
    Route::get('/', \App\Http\Controllers\Observation\IndexController::class)->name('observation.index');
    Route::get('/create', \App\Http\Controllers\Observation\CreateController::class);
    Route::post('', \App\Http\Controllers\Observation\StoreController::class)->name('observation.store');
    Route::get('/{observation}', \App\Http\Controllers\Observation\ShowController::class)->name('observation.show');
    Route::get('/{observation}/edit', \App\Http\Controllers\Observation\EditController::class)->name('observation.edit');
    Route::patch('/{observation}', \App\Http\Controllers\Observation\UpdateController::class)->name('observation.update');
    Route::delete('/{observation}', \App\Http\Controllers\Observation\DestroyController::class)->name('observation.destroy');
});

Route::delete('photos/{photo}', \App\Http\Controllers\Photo\DestroyController::class)->name('photos.destroy');
//Route::delete('photos/bulk-destroy', \App\Http\Controllers\Photo\BulkDestroyController::class)->name('photos.bulkDestroy'); // not use for now


//Route::get('observ/create',App\Livewire\Observation\Create::class)->name('observ.create1');
//Route::post('observ/create',App\Livewire\Observation\Create::class)->name('observ.create1');

Route::group(['prefix' => 'admin','middleware'=>'admin'], function(){
    Route::get('/admin', \App\Http\Controllers\Admin\IndexController::class)->name('admin.index');
    Route::get('/observation', \App\Http\Controllers\Admin\Observation\IndexController::class)->name('admin.observation.index');
});


