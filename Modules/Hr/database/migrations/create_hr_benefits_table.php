<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hr_benefits', function (Blueprint $table) {
            $table->id();
            $table->string('benefit_name');
            $table->text('benefit_description')->nullable();
            $table->string('benefit_type')->nullable();
            $table->text('eligibility_criteria')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hr_benefits');
    }
};
