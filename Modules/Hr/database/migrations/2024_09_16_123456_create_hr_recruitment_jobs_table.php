<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_recruitment_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->text('job_description');
            $table->foreignId('department_id')->nullable()->constrained('hr_departments')->onDelete('cascade');
            $table->string('employment_type')->nullable();
            $table->string('salary_range')->nullable();
            $table->date('posted_date')->nullable();
            $table->date('closing_date')->nullable();
            $table->integer('status')->comment('1 = pending, 2 = paid'); // Adding a comment
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_recruitment_jobs');
    }
};
