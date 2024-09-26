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
        Schema::create('manufacture_work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimation_id')->reference('id')->on('manufacture_estimations');
            $table->string('assign_manager')->nullable();
            $table->string('priority')->nullable();
            $table->text('notes')->nullable();
            $table->date('preferred_date')->nullable();
            $table->text('preference_note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacture_work_orders');
    }
};
