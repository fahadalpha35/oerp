<?php

use Illuminate\Support\Facades\Route;
use Modules\Supplychain\Http\Controllers\PurchaseController;
use Modules\Supplychain\Http\Controllers\PurchasesReturnController;
use Modules\Supplychain\Http\Controllers\SupplychainController;

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

Route::middleware('auth')->group(function () {
    Route::resource('supplychain', SupplychainController::class)->names('supplychain');
    Route::resource('purchase', PurchaseController::class)->names('purchase');
    Route::post('purchase/storeSupplier', [PurchaseController::class, 'storeSupplier'])->name('purchase.storeSupplier');
    Route::get('purchase/supplierDetails/{id}', [PurchaseController::class, 'getSupplierDetails'])->name('purchase.getSupplierDetails');
    Route::resource('purchase-return',PurchasesReturnController::class)->names('purchase-return');
});
