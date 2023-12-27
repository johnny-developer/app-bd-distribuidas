<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', HomeController::class);

Route::post('/clientes', [HomeController::class, 'consultarClientes'])-> name('consultar.clientes');

Route::post('/ventas', [HomeController::class, 'consultarVentas'])->name('consultar.ventas');

