<?php

use Illuminate\Support\Facades\Route;
use Modules\Hr\Http\Controllers\HrController;
use Modules\Hr\Http\Controllers\EmployeeController;
use Modules\Hr\Http\Controllers\BranchController;
use Modules\Hr\Http\Controllers\DepartmentController;
use Modules\Hr\Http\Controllers\DesignationController;

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
    // Route::resource('hr', HrController::class)->names('hr');
    // Route::get('/employees', [EmployeeController::class, 'index'])->name('index');
    Route::resource('branches', BranchController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    // Route::get('designation', [DesignationController::class, 'index'])->name('index');
    // Route::resource('employees', EmployeeController::class);
    // Route::get('export/excel', [EmployeeController::class, 'exportExcel'])->name('export.excel');
    // Route::get('export/csv', [EmployeeController::class, 'exportCSV'])->name('export.csv');

});
