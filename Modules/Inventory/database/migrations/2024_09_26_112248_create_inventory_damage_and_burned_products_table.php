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
        Schema::create('inventory_damage_and_burned_products', function (Blueprint $table) {
            $table->id();
            $table->date('entry_date')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('stock_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit_price', 255)->nullable();
            $table->string('damage_amount', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_damage_and_burned_products');
    }
};
