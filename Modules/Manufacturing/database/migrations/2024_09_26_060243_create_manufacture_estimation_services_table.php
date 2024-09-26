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
        Schema::create('manufacture_estimation_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimation_id')->reference('id')->on('manufacture_estimations');
            $table->foreignId('service_id')->reference('id')->on('manufacture_services');
            $table->integer('quantity');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacture_estimation_services');
    }
};
