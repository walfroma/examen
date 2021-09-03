<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('Cliente', \App\Http\Controllers\ClienteController::class);
Route::resource('Categoria', \App\Http\Controllers\CategoriaController::class);
Route::resource('Producto', \App\Http\Controllers\ProductoController::class);
Route::resource('Factura', \App\Http\Controllers\FacturaController::class);
Route::get('Factura.create', [\App\Http\Controllers\FacturaController::class, 'create']);
Route::post('Factura.create', [\App\Http\Controllers\FacturaController::class, 'store']);
Route::get('Factura/{id}/Detalle', [\App\Http\Controllers\FacturaController::class, 'detalle']);
Route::post('Factura/{id}/Detalle', [\App\Http\Controllers\FacturaController::class, 'store2']);
Route::patch('Factura/{id}/Detalle', [\App\Http\Controllers\FacturaController::class, 'update']);
