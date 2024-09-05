<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
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


// Route::prefix('/backend')->group(function() {

    Route::get('/', [AdminController::class, 'login'])->name('login');

    // Admin Login Route
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login'])->name('login');
    Route::match(['get', 'post'], 'register', [AdminController::class, 'register'])->name('register');

    //division and district depedancy
    Route::post('/division',[AdminController::class,'division']);

    // Route::group(['middleware' => ['Admin']], function() {

    // });

    Route::middleware('auth')->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
        // Admin Dashboard Route
        Route::get('/dashboard', [AdminController::class, 'dashboard']);  
        // Update Admin Password
        Route::match(['get', 'post'], 'update-admin-password', [AdminController::class, 'updateAdminPassword']);
        // Check Admin Password
        Route::post('check-admin-password', [AdminController::class, 'checkAdminPassword']);
        // Update Admin Details
        Route::match(['get', 'post'], 'update-admin-details', [AdminController::class, 'updateAdminDetails']);
    
    });

    // Admin Logout
    Route::match(['get', 'post'], 'update-admin-details', [AdminController::class, 'updateAdminDetails']);
    Route::get('/logout', [AdminController::class, 'logout']);
// });





