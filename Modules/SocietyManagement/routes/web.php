<?php

use Illuminate\Support\Facades\Route;
use Modules\SocietyManagement\Http\Controllers\SocietyManagementController;
use Modules\SocietyManagement\Http\Controllers\SocietyMemberController;
use Modules\SocietyManagement\Http\Controllers\RenewalFeeController;
use Modules\SocietyManagement\Http\Controllers\CommitteeController;
use Modules\SocietyManagement\Http\Controllers\CommitteeMemberController;
use Modules\SocietyManagement\Http\Controllers\SocietyEventController;
use Modules\SocietyManagement\Http\Controllers\FundCollectionController;
use Modules\SocietyManagement\Http\Controllers\SocietyEventSponsorshipController;
use Modules\SocietyManagement\Http\Controllers\SocietyTicketController;
use Modules\SocietyManagement\Http\Controllers\SocietySoldTicketController;
use Modules\SocietyManagement\Http\Controllers\SocietyExpenseController;
use Modules\SocietyManagement\Http\Controllers\SocietyInsuranceController;
use Modules\SocietyManagement\Http\Controllers\SocietyLoanController;

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
    Route::resource('societymanagement', SocietyManagementController::class)->names('societymanagement');
    Route::resource('society_members', SocietyMemberController::class);
    Route::resource('renewal_fees', RenewalFeeController::class);
    Route::get('/generate_renewal_fees', [RenewalFeeController::class, 'generateRenewalFees']);
    Route::get('/update_member_status', [RenewalFeeController::class, 'updateMemberStatus']);
    Route::resource('society_committees', CommitteeController::class);
    Route::resource('committee_members', CommitteeMemberController::class);
    Route::resource('society_events', SocietyEventController::class);
    Route::resource('fund_collections', FundCollectionController::class);
    Route::resource('event_sponsorships', SocietyEventSponsorshipController::class);
    Route::resource('event_tickets', SocietyTicketController::class);
    Route::resource('sold_event_tickets', SocietySoldTicketController::class);
    Route::resource('society_insurances', SocietyInsuranceController::class);
    //member loans
    Route::resource('society_member_loans', SocietyLoanController::class);
    Route::get('/society_member_loan_approval/{loan_id}', [SocietyLoanController::class, 'loan_approval'])->name('loan_approval');

    //loan repayment
    Route::get('/loan_repayment_list', [SocietyLoanController::class, 'loan_repayment_list'])->name('loan_repayment_list');
    Route::post('/repay_loan/{repayment_id}', [SocietyLoanController::class, 'repay_loan'])->name('repay_loan');

    //event and ticket depedancy
    Route::post('/event.ticket.dependancy',[SocietySoldTicketController::class,'event_ticket_dependancy']);
    //ticket and price depedancy
    Route::post('/ticket.price.dependancy',[SocietySoldTicketController::class,'ticket_price_dependancy']);
    Route::resource('society_expenses', SocietyExpenseController::class);

    Route::get('/society_expense_type_list', [SocietyExpenseController::class, 'society_expense_type_list'])->name('society_expense_type_list');
    Route::get('/create_society_expense_type', [SocietyExpenseController::class, 'create_society_expense_type'])->name('create_society_expense_type');
    Route::post('/store_society_expense_type', [SocietyExpenseController::class, 'store_society_expense_type'])->name('store_society_expense_type');
    Route::get('/edit_society_expense_type/{expense_id}', [SocietyExpenseController::class, 'edit_society_expense_type'])->name('edit_society_expense_type');
    Route::post('/update_society_expense_type/{expense_id}', [SocietyExpenseController::class, 'update_society_expense_type'])->name('update_society_expense_type');
    // Route::post('/destroy_society_expense_type/{expense_id}', [SocietyExpenseController::class, 'destroy_society_expense_type'])->name('destroy_society_expense_type');
    Route::delete('/destroy_society_expense_type/{expense_id}', [SocietyExpenseController::class, 'destroy_society_expense_type'])->name('destroy_society_expense_type');

});
