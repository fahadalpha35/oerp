<?php

use Illuminate\Support\Facades\Route;
use Modules\SocietyManagement\Http\Controllers\SocietyManagementController;
use Modules\SocietyManagement\Http\Controllers\SocietyMemberController;
use Modules\SocietyManagement\Http\Controllers\CommitteeController;

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
    // Route::resource('societymanagement', SocietyManagementController::class)->names('societymanagement');
    Route::resource('society_members', SocietyMemberController::class);
    Route::resource('society_committees', CommitteeController::class);
});
