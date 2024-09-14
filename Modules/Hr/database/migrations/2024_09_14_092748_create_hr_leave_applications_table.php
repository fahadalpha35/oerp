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
        Schema::create('hr_leave_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('leave_type_id')->nullable()->constrained('hr_leave_types')->onDelete('cascade');
            $table->integer('application_type')->comment('1 = file attachment, 2= form submission'); // Adding a comment
            $table->string('application_file')->nullable();
            $table->text('application_msg')->nullable();
            $table->date('application_date')->nullable();
            $table->date('application_from')->nullable();
            $table->date('application_to')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('approved_duration')->nullable();
            $table->integer('application_status')->comment('1 = pending, 2 = approved, 3 = declined'); // Adding a comment
            $table->integer('application_approved_user_id')->nullable();
            $table->date('application_approved_date')->nullable();
            $table->date('application_decline_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_leave_applications');
    }
};
