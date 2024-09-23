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
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained('hr_departments')->onDelete('cascade');
            $table->string('employment_type')->nullable();
            $table->string('salary_range')->nullable();
            $table->date('posted_date')->nullable();
            $table->date('closing_date')->nullable();
            $table->integer('status')->comment('1 = open, 2 = closed, 3 = filled'); // Adding a comment
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_recruitment_jobs');
    }
};
