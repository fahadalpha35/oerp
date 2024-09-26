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
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('transaction_type', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
