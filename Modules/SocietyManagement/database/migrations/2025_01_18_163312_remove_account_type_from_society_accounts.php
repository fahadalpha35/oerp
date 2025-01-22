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
        Schema::table('society_accounts', function (Blueprint $table) {
            $table->dropColumn(['account_type', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('society_accounts', function (Blueprint $table) {
            $table->integer('account_type'); // Add back the field
            $table->integer('type'); // Add back the field
        });
    }
};
