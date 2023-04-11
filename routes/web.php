<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PlanLoadController;


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
Route::get('/', [MainController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);
Route::get('/tambah-shipping-company', [ShippingController::class, 'index']);

//ACTIVITY
Route::get('/planload', [PlanLoadController::class, 'index']);
Route::get('/planload/create', [PlanLoadController::class, 'create']);

