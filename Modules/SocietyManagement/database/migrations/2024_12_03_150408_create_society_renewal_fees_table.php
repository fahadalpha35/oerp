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
        Schema::create('society_renewal_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('member_id')->nullable()->constrained('society_members')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->nullable(); // Payment amount
            $table->date('due_date')->nullable(); // Due date for the renewal
            $table->date('payment_date')->nullable(); // Date when payment was made
            $table->integer('status')->nullable()->comment('1 = unpaid, 2 = paid, 3 = overdue');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_renewal_fees');
    }
};
