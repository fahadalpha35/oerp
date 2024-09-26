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
        Schema::create('manufacture_estimations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->reference('id')->on('manufacture_orders');
            $table->string('estimation_number');
            $table->date('estimation_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacture_estimations');
    }
};
