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
        Schema::create('manufacture_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->reference('id')->on('manufacture_clients');
            $table->string('product_name');
            $table->text('internal_notes')->nullable();
            $table->string('unit_of_measure');
            $table->string('purchase_unit_of_measure');
            $table->decimal('sales_price', 10, 2);
            $table->decimal('cost', 10, 2);
            $table->string('barcode')->nullable();
            $table->string('sku_code')->nullable();
            $table->string('image')->nullable();
            $table->date('delivery_date')->nullable();
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('manufacture_orders');
    }
};
