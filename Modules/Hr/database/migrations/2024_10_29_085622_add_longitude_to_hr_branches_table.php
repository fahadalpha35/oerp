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
        Schema::table('hr_branches', function (Blueprint $table) {
            $table->text('longitude')->nullable();
            $table->text('latitude')->nullable();         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hr_branches', function (Blueprint $table) {
            
        });
    }
};
