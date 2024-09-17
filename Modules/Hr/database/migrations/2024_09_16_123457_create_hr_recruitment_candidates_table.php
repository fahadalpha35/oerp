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
            $table->foreignId('job_id')->nullable()->constrained('hr_recruitment_jobs')->onDelete('cascade');
            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->integer('status')->comment('1 = applied, 2 = interviewed, 3 = hired, 4 = rejected'); // Adding a comment
            $table->date('applied_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_recruitment_candidates');
    }
};
