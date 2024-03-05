<?php

use App\Http\Controllers\DireccionPersonalController;
use App\Models\DireccionPersonal;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [ProductoController::class, 'inicioRestaurantes'])->name('index');


Route::prefix('direcciones-personales')->group(function (){
    Route::get('/{id}',[DireccionPersonalController::class,'show'])->name('direccion-personal.show');
    Route::get('/create/direccion-personal',[DireccionPersonalController::class,'create'])->name('direccion-personal.create');
    Route::post('/',[DireccionPersonalController::class,'store'])->name('direccion-personal.store');
    Route::get('/{id}/edit',[DireccionPersonalController::class,'edit'])->name('direccion-personal.edit');
    Route::put('/{id}',[DireccionPersonalController::class,'update'])->name('direccion-personal.update');
    Route::delete('/{id}',[DireccionPersonalController::class,'destroy'])->name('direccion-personal.destroy');
});

Route::group(['prefix' => 'productos'], function () {
    Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/ofertas', [ProductoController::class, 'offers'])->name('productos.offers');
    Route::get('/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::get('/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::post('/', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/{producto}/update', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/{producto}/image', [ProductoController::class, 'editImage'])->name('productos.editImage');
    Route::patch('/{producto}/image', [ProductoController::class, 'updateImage'])->name('productos.updateImage');
});

Route::group(['prefix' => 'categorias'], function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::get('/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/{categoria}/update', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});
