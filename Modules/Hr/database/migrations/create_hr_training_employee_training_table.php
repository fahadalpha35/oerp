<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_employee_training', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('training_program_id');
            $table->enum('completion_status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->date('completion_date')->nullable();
            $table->timestamps();

            // Optionally, you can add indexes for these columns
            $table->index('employee_id');
            $table->index('training_program_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_employee_training');
    }
};
