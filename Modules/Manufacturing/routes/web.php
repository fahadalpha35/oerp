<?php

use Illuminate\Support\Facades\Route;
use Modules\Manufacturing\Http\Controllers\ManufacturingController;
use Modules\Manufacturing\Http\Controllers\EstimationController;
use Modules\Manufacturing\Http\Controllers\OrderController;
use Modules\Manufacturing\Http\Controllers\PartController;
use Modules\Manufacturing\Http\Controllers\ServiceController;
use Modules\Manufacturing\Http\Controllers\WorkOrderController;

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

Route::group([], function () {
    Route::resource('manufacturing', ManufacturingController::class);
    Route::resource('estimation', EstimationController::class);
    Route::resource('order', OrderController::class);
    Route::resource('parts', PartController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('workorder', WorkOrderController::class);
});
