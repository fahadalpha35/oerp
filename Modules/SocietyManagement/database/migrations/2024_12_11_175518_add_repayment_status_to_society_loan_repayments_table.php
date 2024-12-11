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
        Schema::table('society_loan_repayments', function (Blueprint $table) {
            $table->integer('repayment_status')->nullable()->comment('1 = unpaid, 2 = partially_paid, 3 = paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('society_loan_repayments', function (Blueprint $table) {
            
        });
    }
};
