<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_employee_benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('benefit_id');
            $table->date('enrollment_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Optionally, you can add indexes for these columns
            $table->index('employee_id');
            $table->index('benefit_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_employee_benefits');
    }
};
