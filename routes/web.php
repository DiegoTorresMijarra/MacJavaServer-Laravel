<?php

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
    Route::get('/{id}',[DireccionPersonal::class,'show'])->name('direccion-personal.show');
    Route::get('/create',[DireccionPersonal::class,'create'])->name('direccion-personal.create');
    Route::post('/',[DireccionPersonal::class,'store'])->name('direccion-personal.store');
    Route::get('/{id}/edit',[DireccionPersonal::class,'edit'])->name('direccion-personal.edit');
    Route::put('/{id}',[DireccionPersonal::class,'update'])->name('direccion-personal.update');
    Route::delete('/{id}',[DireccionPersonal::class,'destroy'])->name('direccion-personal.destroy');
});
