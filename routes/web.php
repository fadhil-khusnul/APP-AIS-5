<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PlanLoadController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\DepoController;
use App\Http\Controllers\PlanDischargeController;
use App\Http\Controllers\ProcessLoadController;
use App\Http\Controllers\SealController;
use App\Http\Controllers\PelabuhanController;
use App\Http\Controllers\PengirimController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\TruckingController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\StuffingController;
use App\Http\Controllers\StrippingController;


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

//DATA
Route::get('/', [DataController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);

Route::post('/shipping-company', [ShippingController::class, 'store']);
Route::get('/company/{id}/edit', [ShippingController::class, 'edit']);
Route::put('/company/{id}', [ShippingController::class, 'update']);
Route::delete('/company/{id}', [ShippingController::class, 'destroy']);


Route::post('/add-depo', [DepoController::class, 'store']);
Route::get('/depo/{id}/edit', [DepoController::class, 'edit']);
Route::put('/depo/{id}', [DepoController::class, 'update']);
Route::delete('/depo/{id}', [DepoController::class, 'destroy']);

Route::post('/add-pelabuhan', [PelabuhanController::class, 'store']);
Route::get('/pelabuhan/{id}/edit', [PelabuhanController::class, 'edit']);
Route::put('/pelabuhan/{id}', [PelabuhanController::class, 'update']);
Route::delete('/pelabuhan/{id}', [PelabuhanController::class, 'destroy']);


Route::post('/add-pengirim', [PengirimController::class, 'store']);
Route::get('/pengirim/{id}/edit', [PengirimController::class, 'edit']);
Route::put('/pengirim/{id}', [PengirimController::class, 'update']);
Route::delete('/pengirim/{id}', [PengirimController::class, 'destroy']);

Route::post('/add-penerima', [PenerimaController::class, 'store']);
Route::get('/penerima/{id}/edit', [PenerimaController::class, 'edit']);
Route::put('/penerima/{id}', [PenerimaController::class, 'update']);
Route::delete('/penerima/{id}', [PenerimaController::class, 'destroy']);


Route::post('/add-biaya', [BiayaController::class, 'store']);
Route::get('/biaya/{id}/edit', [BiayaController::class, 'edit']);
Route::put('/biaya/{id}', [BiayaController::class, 'update']);
Route::delete('/biaya/{id}', [BiayaController::class, 'destroy']);

Route::post('/add-trucking', [TruckingController::class, 'store']);
Route::get('/trucking/{id}/edit', [TruckingController::class, 'edit']);
Route::put('/trucking/{id}', [TruckingController::class, 'update']);
Route::delete('/trucking/{id}', [TruckingController::class, 'destroy']);

Route::post('/add-container', [ContainerController::class, 'store']);
Route::get('/container/{id}/edit', [ContainerController::class, 'edit']);
Route::put('/container/{id}', [ContainerController::class, 'update']);
Route::delete('/container/{id}', [ContainerController::class, 'destroy']);

Route::post('/add-stuffing', [StuffingController::class, 'store']);
Route::get('/stuffing/{id}/edit', [StuffingController::class, 'edit']);
Route::put('/stuffing/{id}', [StuffingController::class, 'update']);
Route::delete('/stuffing/{id}', [StuffingController::class, 'destroy']);

Route::post('/add-stripping', [StrippingController::class, 'store']);
Route::get('/stripping/{id}/edit', [StrippingController::class, 'edit']);
Route::put('/stripping/{id}', [StrippingController::class, 'update']);
Route::delete('/stripping/{id}', [StrippingController::class, 'destroy']);

//ACTIVITY

//plan
Route::get('/planload', [PlanLoadController::class, 'index']);
Route::get('/planload/create', [PlanLoadController::class, 'create']);
Route::get('/plandischarge', [PlanDischargeController::class, 'index']);
Route::get('/plandischarge/create', [PlanDischargeController::class, 'create']);

//process
Route::get('/processload', [ProcessLoadController::class, 'index']);
Route::get('/processload/create', [ProcessLoadController::class, 'create']);


//seal
Route::get('/seal', [SealController::class, 'index']);
