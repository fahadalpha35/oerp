<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('manufacture_services_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->reference('id')->on('manufacture_services');
            $table->string('task_name');
            $table->integer('duration');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacture_services_tasks');
    }
};
