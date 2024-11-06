<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MasterAdminController;
use App\Http\Controllers\Backend\EmployeeUsersController;

// use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('backend.login');
});


#### CLEAR ALL IN ONE ####
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Caches cleared and configuration files regenerated.';
});



    Route::get('/', [MasterAdminController::class, 'login'])->name('login');

    // Admin Login Route
    Route::match(['get', 'post'], 'login', [MasterAdminController::class, 'login'])->name('login');
    Route::match(['get', 'post'], 'register', [MasterAdminController::class, 'register'])->name('register');

    //division and district depedancy
    Route::post('/division',[MasterAdminController::class,'division']);


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // Dashboard Route
        Route::get('/dashboard', [MasterAdminController::class, 'dashboard']);
        // Update Password
        Route::match(['get', 'post'], 'update-password', [MasterAdminController::class, 'updatePassword']);
        // Update Personal Details
        Route::match(['get', 'post'], 'update-personal-details', [MasterAdminController::class, 'updatePersonalDetails'])->name('update-personal-details');

    });

        // Admin Logout
        Route::get('/logout', [MasterAdminController::class, 'logout']);






