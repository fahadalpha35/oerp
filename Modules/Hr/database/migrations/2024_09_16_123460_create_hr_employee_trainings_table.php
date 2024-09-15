<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_employee_trainings', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('employee_id')->nullable()->constrained('hr_employees')->onDelete('cascade');
            // $table->foreignId('manager_id')->nullable()->constrained('hr_managers')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('training_program_id')->nullable()->constrained('hr_training_programs')->onDelete('cascade');
            $table->date('completion_date')->nullable();
            $table->integer('completion_status')->comment('1 = not_started, 2 = in_progress, 3 = completed'); // Adding a comment
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_employee_trainings');
    }
};
