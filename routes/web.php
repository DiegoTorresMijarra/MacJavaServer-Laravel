<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DireccionPersonalController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
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

Route::prefix('direcciones-personales')->group( function (){
    Route::get('/{id}',[DireccionPersonalController::class,'show'])->name('direccion-personal.show')->middleware('auth');
    Route::get('/create/direccion-personal',[DireccionPersonalController::class,'create'])->name('direccion-personal.create')->middleware('auth');
    Route::post('/',[DireccionPersonalController::class,'store'])->name('direccion-personal.store')->middleware('auth');
    Route::get('/{id}/edit',[DireccionPersonalController::class,'edit'])->name('direccion-personal.edit')->middleware('auth');
    Route::put('/{id}',[DireccionPersonalController::class,'update'])->name('direccion-personal.update')->middleware('auth');
    Route::delete('/{id}',[DireccionPersonalController::class,'destroy'])->name('direccion-personal.destroy')->middleware('auth');
});

Route::group(['prefix' => 'productos'], function () {
    Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/ofertas', [ProductoController::class, 'offers'])->name('productos.offers');
    Route::get('/create', [ProductoController::class, 'create'])->name('productos.create')->middleware('auth','admin');
    Route::get('/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::post('/', [ProductoController::class, 'store'])->name('productos.store')->middleware('auth','admin');
    Route::get('/{producto}/update', [ProductoController::class, 'edit'])->name('productos.edit')->middleware('auth','admin');
    Route::put('/{producto}', [ProductoController::class, 'update'])->name('productos.update')->middleware('auth','admin');
    Route::delete('/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy')->middleware('auth','admin');
    Route::get('/{producto}/image', [ProductoController::class, 'editImage'])->name('productos.editImage')->middleware('auth','admin');
    Route::patch('/{producto}/image', [ProductoController::class, 'updateImage'])->name('productos.updateImage')->middleware('auth','admin');
});

Route::group(['prefix' => 'categorias'], function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index')->middleware('auth','admin');
    Route::get('/create', [CategoriaController::class, 'create'])->name('categorias.create')->middleware('auth','admin');
    Route::get('/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show')->middleware('auth','admin');
    Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store')->middleware('auth','admin');
    Route::get('/{categoria}/update', [CategoriaController::class, 'edit'])->name('categorias.edit')->middleware('auth','admin');
    Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update')->middleware('auth','admin');
    Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware('auth','admin');
});

Route::prefix('users')->group( function (){
    Route::get('/',[UserController::class,'index'])->name('users.index');
    Route::get('/create/user',[UserController::class,'create'])->name('users.create');
    Route::get('/{user}',[UserController::class,'show'])->name('users.show');
    Route::get('/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('/{user}',[UserController::class,'update'])->name('users.update');
    Route::delete('/{user}',[UserController::class,'destroy'])->name('users.destroy');
});

Route::prefix('carrito')->group( function (){
   Route::post('/',[CarritoController::class,'addLinea'])->name('add-linea')->middleware('auth');
   Route::get('/',[CarritoController::class,'getCarritoSession'])->name('carrito')->middleware('auth');
   Route::post('/create',[CarritoController::class,'createPedido'])->name('finalizar-pedido')->middleware('auth');
   Route::delete('/{index}',[CarritoController::class,'deleteLinea'])->name('delete-linea')->middleware('auth');
});

Route::get('/pedido/details/{id}',[PedidoController::class,'show'])->name('pedido.details')->middleware('auth');

Route::get('/pedido/{id}/pdf', [PedidoController::class,'toPdf'])->name('pdf')->middleware('auth');
