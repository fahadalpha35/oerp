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
        Schema::create('society_loan_repayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->nullable()->constrained('society_member_loans')->onDelete('cascade');
            $table->date('due_date')->nullable();
            $table->decimal('amount_due', 10, 2)->nullable();
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->integer('status')->nullable()->comment('1 = unpaid, 2 = paid');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_loan_repayments');
    }
};
