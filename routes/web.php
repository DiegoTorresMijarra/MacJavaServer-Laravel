<?php

use App\Http\Controllers\DireccionController;
use App\Http\Controllers\RestauranteController;
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

Route::group(['prefix' => 'restaurantes'], function () {
    Route::get('/', [RestauranteController::class, 'index'])->name('restaurantes.index');
    Route::get('/{id}', [RestauranteController::class, 'show'])->name('restaurantes.show');
    Route::get('/create/restaurante', [RestauranteController::class, 'create'])->name('restaurantes.create');
    Route::post('/', [RestauranteController::class, 'store'])->name('restaurantes.store');
    Route::get('/{id}/edit', [RestauranteController::class, 'edit'])->name('restaurantes.edit');
    Route::put('/{id}', [RestauranteController::class, 'update'])->name('restaurantes.update');
    Route::delete('/{id}', [RestauranteController::class, 'destroy'])->name('restaurantes.destroy');
});

Route::group(['prefix' => 'direcciones'], function () {
    Route::get('/', [DireccionController::class, 'index'])->name('direcciones.index');
    Route::get('/{id}', [DireccionController::class, 'show'])->name('direcciones.show');
    Route::get('/create/restaurante', [DireccionController::class, 'create'])->name('direcciones.create');
    Route::post('/', [DireccionController::class, 'store'])->name('direcciones.store');
    Route::get('/{id}/edit', [DireccionController::class, 'edit'])->name('direcciones.edit');
    Route::put('/{id}', [DireccionController::class, 'update'])->name('direcciones.update');
    Route::delete('/{id}', [DireccionController::class, 'destroy'])->name('direcciones.destroy');
});
