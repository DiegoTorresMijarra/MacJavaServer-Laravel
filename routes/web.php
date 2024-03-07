<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\DireccionPersonalController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
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

Auth::routes();


// Usuarios  -> admin
Route::prefix('users')->group( function (){
    Route::get('/',[UserController::class,'index'])->name('users.index')->middleware('auth','admin');
    Route::get('/create/user',[UserController::class,'create'])->name('users.create')->middleware('auth','admin');
    Route::post('/store/user',[UserController::class,'store'])->name('users.store')->middleware('auth','admin');
    Route::get('/{id}',[UserController::class,'show'])->name('users.show')->middleware('auth','admin'); //es el de admin
    Route::put('/{id}/edit',[UserController::class,'editImage'])->name('users.updateImage')->middleware('auth','admin');
  //  Route::put('/{id}',[UserController::class,'update'])->name('users.update');
    Route::delete('/{id}',[UserController::class,'destroy'])->name('users.destroy')->middleware('auth','admin');
});

Route::get('/', [RestauranteController::class, 'inicioRestaurantes'])->name('index');

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

// Categorias -> admin
Route::group(['prefix' => 'categorias'], function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index')->middleware('auth','admin');
    Route::get('/create', [CategoriaController::class, 'create'])->name('categorias.create')->middleware('auth','admin');
    Route::get('/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show')->middleware('auth','admin');
    Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store')->middleware('auth','admin');
    Route::get('/{categoria}/update', [CategoriaController::class, 'edit'])->name('categorias.edit')->middleware('auth','admin');
    Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update')->middleware('auth','admin');
    Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware('auth','admin');
});

// Trabajadores -> admin
Route::group(['prefix' => 'trabajadores'], function () {
    Route::get('/', [TrabajadorController::class, 'index'])->name('trabajadores.index')->middleware('auth','admin');
    Route::get('/create', [TrabajadorController::class, 'create'])->name('trabajadores.create')->middleware('auth','admin');
    Route::get('/{trabajador}', [TrabajadorController::class, 'show'])->name('trabajadores.show')->middleware('auth','admin');
    Route::get('/{trabajador}/update', [TrabajadorController::class, 'edit'])->name('trabajadores.edit')->middleware('auth','admin');
    Route::put('/{trabajador}', [TrabajadorController::class, 'update'])->name('trabajadores.update')->middleware('auth','admin');
    Route::delete('/{trabajador}', [TrabajadorController::class, 'destroy'])->name('trabajadores.destroy')->middleware('auth','admin');
});


// carrito ->user
Route::prefix('carrito')->group( function (){
   Route::post('/',[CarritoController::class,'addLinea'])->name('add-linea')->middleware('auth','user');
   Route::get('/',[CarritoController::class,'getCarritoSession'])->name('carrito')->middleware('auth','user');
   Route::post('/create',[CarritoController::class,'createPedido'])->name('finalizar-pedido')->middleware('auth','user');
   Route::delete('/{index}',[CarritoController::class,'deleteLinea'])->name('delete-linea')->middleware('auth','user');
});

//pedidos-> auth (los trabajadores y admin pueden consutar y descargar datos)
Route::get('/pedido/details/{id}',[PedidoController::class,'show'])->name('pedido.details')->middleware('auth');
Route::get('/pedido/{id}/pdf', [PedidoController::class,'toPdf'])->name('pdf')->middleware('auth');

//, direcciones-personales  -> user
Route::prefix('direcciones-personales')->group( function (){
    Route::get('/{id}',[DireccionPersonalController::class,'show'])->name('direccion-personal.show')->middleware('auth');
    Route::get('/create/direccion-personal',[DireccionPersonalController::class,'create'])->name('direccion-personal.create')->middleware('auth');
    Route::post('/',[DireccionPersonalController::class,'store'])->name('direccion-personal.store')->middleware('auth');
    Route::get('/{id}/edit',[DireccionPersonalController::class,'edit'])->name('direccion-personal.edit')->middleware('auth');
    Route::put('/{id}',[DireccionPersonalController::class,'update'])->name('direccion-personal.update')->middleware('auth');
    Route::delete('/{id}',[DireccionPersonalController::class,'destroy'])->name('direccion-personal.destroy')->middleware('auth');
});


// home -> auth
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


// Restaurantes -> crud admin, get-> all
Route::group(['prefix' => 'restaurantes'], function () {
    Route::get('/', [RestauranteController::class, 'index'])->name('restaurantes.index');
    Route::get('/{id}', [RestauranteController::class, 'show'])->name('restaurantes.show');
    Route::get('/create/restaurante', [RestauranteController::class, 'create'])->name('restaurantes.create')->middleware('auth','admin');
    Route::post('/', [RestauranteController::class, 'store'])->name('restaurantes.store')->middleware('auth','admin');
    Route::get('/{id}/edit', [RestauranteController::class, 'edit'])->name('restaurantes.edit')->middleware('auth','admin');
    Route::put('/{id}', [RestauranteController::class, 'update'])->name('restaurantes.update')->middleware('auth','admin');
    Route::delete('/{id}', [RestauranteController::class, 'destroy'])->name('restaurantes.destroy')->middleware('auth','admin');
});

// direcciones-> admin
Route::group(['prefix' => 'direcciones'], function () {
    Route::get('/{id}', [DireccionController::class, 'show'])->name('direcciones.show')->middleware('auth','admin');
    Route::get('/create/direccion', [DireccionController::class, 'create'])->name('direcciones.create')->middleware('auth','admin');
    Route::post('/', [DireccionController::class, 'store'])->name('direcciones.store')->middleware('auth','admin');
    Route::get('/{id}/edit', [DireccionController::class, 'edit'])->name('direcciones.edit')->middleware('auth','admin');
    Route::put('/{id}', [DireccionController::class, 'update'])->name('direcciones.update')->middleware('auth','admin');
    Route::delete('/{id}', [DireccionController::class, 'destroy'])->name('direcciones.destroy')->middleware('auth','admin');
});
