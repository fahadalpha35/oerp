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
        Schema::create('society_fund_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained('society_events')->onDelete('cascade');
            $table->foreignId('society_member_id')->nullable()->constrained('society_members')->onDelete('cascade');
            $table->integer('purpose')->comment('1 = event, 2 = others');
            $table->text('description')->nullable();
            $table->decimal('fund_amount', 10, 2)->nullable();
            $table->date('fund_collection_date')->nullable();
            $table->integer('fund_collection_status')->comment('1 = pending, 2 = collected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_fund_collections');
    }
};
