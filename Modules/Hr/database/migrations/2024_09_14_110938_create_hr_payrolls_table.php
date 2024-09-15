<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hr_payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->date('salary_date')->nullable();
            $table->string('per_day_salary')->nullable();
            $table->integer('total_working_day')->nullable();
            $table->integer('total_leave')->nullable();
            $table->integer('total_number_of_pay_day')->nullable();
            $table->string('monthly_salary')->nullable();
            $table->string('monthly_bonus')->nullable();

            $table->integer('total_overtime_hours')->nullable(); //calculate total_overtime_hours from sum of overtime_hours of salary eligible month from hr_overtimes table 
            $table->string('overtime_rate')->nullable();
            $table->string('total_overtime_paid_amount')->nullable(); //total_overtime_paid_amount = total_overtime_hours*overtime_rate

            $table->string('total_daily_allowance')->nullable();
            $table->string('total_travel_allowance')->nullable();
            $table->string('rental_cost_allowance')->nullable();
            $table->string('hospital_bill_allowance')->nullable();
            $table->string('insurance_allowance')->nullable();

            $table->string('sales_commission')->nullable();
            $table->string('retail_commission')->nullable();
            $table->string('total_others')->nullable();

            $table->string('total_salary')->nullable();
            $table->string('yearly_bonus')->nullable();
            $table->string('gross_pay')->nullable();

            $table->string('deduction')->nullable();
            $table->string('net_pay')->nullable();

            $table->integer('payment_status')->comment('1 = pending, 2 = paid'); // Adding a comment
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_payrolls');
    }
};
