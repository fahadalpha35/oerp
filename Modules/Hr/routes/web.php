<?php

use Illuminate\Support\Facades\Route;
use Modules\Hr\Http\Controllers\HrController;
use Modules\Hr\Http\Controllers\BranchController;
use Modules\Hr\Http\Controllers\DepartmentController;
use Modules\Hr\Http\Controllers\DesignationController;
use Modules\Hr\Http\Controllers\EmployeeController;
use Modules\Hr\Http\Controllers\PostsController;

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

    //----------**** Dependancy route (start) *******--------------

    //level and designation depedancy
    Route::post('/level.designation.dependancy',[EmployeeController::class,'level_designation_dependancy']);
    //branch and department depedancy
    Route::post('/branch.department.dependancy',[EmployeeController::class,'branch_dpartment_dependancy']);
    //----------**** Dependancy route (end) *******--------------

    Route::resource('employees', EmployeeController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
});
