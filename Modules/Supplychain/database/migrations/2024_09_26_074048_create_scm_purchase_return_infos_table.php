<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scm_purchase_return_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_return_id')->reference('id')->on('scm_purchase_returns');
            $table->foreignId('product_id')->reference('id')->on('products');
            $table->decimal('price', 10, 2);
            $table->decimal('Quantity', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scm_purchase_return_infos');
    }
};
