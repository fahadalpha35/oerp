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
        Schema::create('hr_attendance_users', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->nullable();
            $table->foreignId('system_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->integer('machine_user_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('hr_branches')->onDelete('cascade');
            $table->date('user_create_date')->nullable();
            $table->string('password')->nullable();
            $table->string('card_no')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_attendance_users');
    }
};
