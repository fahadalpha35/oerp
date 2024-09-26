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
        Schema::create('inventory_stock', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit_price', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_stock');
    }
};
