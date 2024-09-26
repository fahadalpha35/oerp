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
        Schema::create('inventory_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->date('order_date')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_orders');
    }
};
