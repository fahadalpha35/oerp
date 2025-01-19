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
use Modules\SocietyManagement\Http\Controllers\SocietyAccountController;

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
    Route::get('/society_expense_report', [SocietyExpenseController::class, 'society_expense_report'])->name('society_expense_report');
    Route::post('/society_expense_report_submit', [SocietyExpenseController::class, 'society_expense_report_submit'])->name('society_expense_report_submit');

    //--------- ** Accounts **----------------

    //profit and loss
    Route::get('/society_profit_and_loss', [SocietyAccountController::class, 'profit_and_loss']);
    Route::post('/society_profit_and_loss_submit', [SocietyAccountController::class, 'profit_and_loss_data'])->name('society_profit_and_loss_submit');

    //budget v/s collected fund
    Route::get('/budget_and_collected_fund', [SocietyAccountController::class, 'budget_and_collected_fund']);
    Route::post('/budget.fund.dependancy',[SocietyAccountController::class,'budget_and_collected_fund_dependancy']);

    //account types
    Route::get('/society_account_type_list', [SocietyAccountController::class, 'society_account_type_list'])->name('society_account_type_list');
    Route::get('/add_society_account_type', [SocietyAccountController::class, 'add_society_account_type'])->name('add_society_account_type');
    Route::post('/store_society_account_type', [SocietyAccountController::class, 'store_society_account_type'])->name('store_society_account_type');
    Route::get('/edit_society_account_type/{account_id}', [SocietyAccountController::class, 'edit_society_account_type'])->name('edit_society_account_type');
    Route::post('/update_society_account_type/{account_id}', [SocietyAccountController::class, 'update_society_account_type'])->name('update_society_account_type');
    Route::delete('/delete_society_account_type/{account_id}', [SocietyAccountController::class, 'delete_society_account_type'])->name('delete_society_account_type');

    //transaction
    Route::get('/society_transaction_list', [SocietyAccountController::class, 'society_transaction_list'])->name('society_transaction_list');
    Route::get('/add_society_transaction', [SocietyAccountController::class, 'add_society_transaction'])->name('add_society_transaction');
    Route::post('/store_society_transaction', [SocietyAccountController::class, 'store_society_transaction'])->name('store_society_transaction');
    // Route::get('/edit_society_transaction/{transaction_id}', [SocietyAccountController::class, 'edit_society_transaction'])->name('edit_society_transaction');

    //balance sheet report
    Route::get('/society_balance_sheet_report', [SocietyAccountController::class, 'society_balance_sheet_report'])->name('society_balance_sheet_report');
    // Route::post('/society_balance_transaction_report_submit', [SocietyAccountController::class, 'society_balance_transaction_report_submit'])->name('society_balance_transaction_report_submit');
});
