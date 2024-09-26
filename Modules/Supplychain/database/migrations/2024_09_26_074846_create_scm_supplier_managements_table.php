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
        Schema::create('scm_supplier_managements', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('phone',50);
            $table->string('email',50);
            $table->string('company', 100);
            $table->string('area', 50);
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scm_supplier_managements');
    }
};
