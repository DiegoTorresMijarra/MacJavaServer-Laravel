<?php

use App\Http\Controllers\DireccionPersonalController;
use App\Models\DireccionPersonal;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('direcciones-personales')->group(function (){
    Route::get('/', function () {
        return DireccionPersonal::first();
    });
    Route::get('/{id}',[DireccionPersonalController::class,'show'])->name('direccion-personal.show');
    Route::get('/create',[DireccionPersonalController::class,'create'])->name('direccion-personal.create');
    Route::post('/',[DireccionPersonalController::class,'store'])->name('direccion-personal.store');
    Route::get('/{id}/edit',[DireccionPersonalController::class,'edit'])->name('direccion-personal.edit');
    Route::put('/{id}',[DireccionPersonalController::class,'update'])->name('direccion-personal.update');
    Route::delete('/{id}',[DireccionPersonalController::class,'destroy'])->name('direccion-personal.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
