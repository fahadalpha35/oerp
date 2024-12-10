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
        Schema::create('society_member_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('member_id')->nullable()->constrained('society_members')->onDelete('cascade');
            $table->decimal('loan_amount', 10, 2)->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();
            $table->decimal('total_amount_due', 10, 2)->nullable();
            $table->integer('repayment_term')->nullable()->comment('Number of months');
            $table->date('loan_start_date')->nullable();
            $table->date('loan_end_date')->nullable();
            $table->integer('status')->nullable()->comment('1 = pending, 2 = approved, 3 = rejected, 4 = completed');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_member_loans');
    }
};
