<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_employee_self_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('request_type');
            $table->text('request_details')->nullable();
            $table->enum('request_status', ['pending', 'approved', 'denied'])->default('pending');
            $table->date('request_date')->nullable();
            $table->timestamps();

            // Optionally, you can add an index for the employee_id column
            $table->index('employee_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_employee_self_services');
    }
};
