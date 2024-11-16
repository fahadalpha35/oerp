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
        Schema::create('society_sold_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained('society_events')->onDelete('cascade');
            $table->foreignId('ticket_id')->nullable()->constrained('society_tickets')->onDelete('cascade');
            $table->date('ticket_selling_date')->nullable();
            $table->integer('sold_ticket_quantity')->nullable();
            $table->decimal('total_revenue', 10, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_sold_tickets');
    }
};
