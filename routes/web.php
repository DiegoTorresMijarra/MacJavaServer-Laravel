<?php

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
