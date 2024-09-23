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
            $table->foreignId('candidate_id')->nullable()->constrained('hr_recruitment_candidates')->onDelete('cascade');
            $table->date('interview_date');
            $table->time('interview_time');
            $table->text('interviewers')->nullable();
            $table->text('interview_feedback')->nullable();
            $table->integer('status')->comment('1 = scheduled, 2 = completed, 3 = cancelled'); // Adding a comment
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_recruitment_interviews');
    }
};
