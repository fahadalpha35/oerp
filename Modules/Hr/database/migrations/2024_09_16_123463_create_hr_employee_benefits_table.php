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
            $table->foreignId('employee_id')->constrained('hr_employees')->onDelete('cascade'); // Foreign key to employees table
            $table->foreignId('manager_id')->constrained('hr_managers')->onDelete('cascade'); // Foreign key to managers table
            $table->date('enrollment_date')->nullable();
            $table->integer('status')->comment('1 = active, 2 = inactive'); // Adding a comment
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_employee_benefits');
    }
};
