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
        Schema::create('scm_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->reference('id')->on('scm_supplier_managements');
            $table->date('purchase_date');
            $table->string('invoice_no');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('delivary_cost', 10, 2);
            $table->decimal('service_cost', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('due', 10, 2);
            $table->decimal('paid', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scm_purchases');
    }
};
