<?php

use Illuminate\Support\Facades\Route;
use Modules\Hr\Http\Controllers\HrController;
use Modules\Hr\Http\Controllers\BranchController;
use Modules\Hr\Http\Controllers\DepartmentController;
use Modules\Hr\Http\Controllers\DesignationController;
use Modules\Hr\Http\Controllers\EmployeeController;
use Modules\Hr\Http\Controllers\PostsController;
use Modules\Hr\Http\Controllers\LeaveController;
use Modules\Hr\Http\Controllers\PayrollController;

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
    Route::resource('designations', DesignationController::class);
    //Leave type
    Route::resource('leave_types', LeaveController::class);
   
    //ways of applying for leave
    Route::get('/apply_leave', [LeaveController::class, 'apply_leave'])->name('apply_leave');

    // leave application (file attachment)
    Route::get('/leave_application_file_attachment', [LeaveController::class, 'leave_application_file_attachment'])->name('leave_application_file_attachment');
    Route::post('/leave_application_attach_file_store',[LeaveController::class,'leave_application_attach_file_store']);
    Route::get('/edit_file_attachment/{leave_id}', [LeaveController::class, 'edit_file_attachment'])->name('edit_file_attachment');
    Route::post('/update_leave_application_with_attachment/{leave_id}', [LeaveController::class, 'update_with_attachment']);

    // leave application (form submission)
    Route::get('/leave_application_form_fillup', [LeaveController::class, 'leave_application_form_fillup'])->name('leave_application_form_fillup');
    Route::post('/leave_application_form_fillup_store', [LeaveController::class, 'leave_application_form_fillup_store']);
    Route::get('/edit_leave_application/{leave_id}', [LeaveController::class, 'edit_leave_application'])->name('edit_leave_application');
    Route::post('/update_leave_application_form_fillup/{leave_id}', [LeaveController::class, 'update_with_form_fillup']);

    //leave application list
    Route::get('/leave_applications', [LeaveController::class, 'leave_applications'])->name('leave_applications');

    //leave application (approval)
    Route::get('/leave_application_approval_list', [LeaveController::class, 'leave_application_approval_list'])->name('leave_application_approval_list');
    Route::get('/review_leave/{leave_id}', [LeaveController::class, 'review_leave'])->name('review_leave');
    Route::post('/approve_leave', [LeaveController::class, 'approve_leave'])->name('approve_leave');
    Route::post('/decline_leave', [LeaveController::class, 'decline_leave'])->name('decline_leave');

    //payroll
    Route::resource('payrolls', PayrollController::class);

    //dependencies (payroll)
    Route::post('/member_details_dependancy', [PayrollController::class, 'member_details_dependancy']);
    
    Route::get('/payroll_show_data/{payroll_id}', [PayrollController::class, 'payroll_show_data'])->name('payroll_show_data');

});
