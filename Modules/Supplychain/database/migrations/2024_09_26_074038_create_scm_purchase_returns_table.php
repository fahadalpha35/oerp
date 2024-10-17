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
        Schema::create('scm_purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->reference('id')->on('scm_purchases');
            $table->decimal('total', 10, 2);
            $table->text('note');
            $table->date('purchase_return_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scm_purchase_returns');
    }
};
