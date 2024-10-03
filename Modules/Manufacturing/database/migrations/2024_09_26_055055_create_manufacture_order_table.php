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
            $table->foreignId('product_id')->reference('id')->on('inventory_products');
            $table->string('quantity');
            $table->decimal('total', 10, 2);
            $table->date('delivery_date')->nullable();
            $table->text('internal_notes')->nullable();
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
