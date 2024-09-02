<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_recruitment_interviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->date('interview_date');
            $table->time('interview_time');
            $table->text('interviewers')->nullable();
            $table->text('interview_feedback')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();

            // Optionally, you can add an index for the candidate_id column
            $table->index('candidate_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_recruitment_interviews');
    }
};
