<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_recruitment_candidates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('job_id');
            $table->text('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['applied', 'interviewed', 'hired', 'rejected'])->default('applied');
            $table->date('applied_date')->nullable();
            $table->timestamps();

            // Optionally, you can add an index for the job_id column
            $table->index('job_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_recruitment_candidates');
    }
};
