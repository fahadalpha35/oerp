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
        Schema::create('inventory_log', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address', 500)->nullable();
            $table->string('url', 1000)->nullable();
            $table->integer('company_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->integer('active_status')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_log');
    }
};
