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
        Schema::create('society_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained('society_events')->onDelete('cascade');
            $table->integer('ticket_type')->comment('1 = regular, 2 = vip');
            $table->decimal('ticket_price', 10, 2)->nullable();
            $table->integer('ticket_quantity')->nullable();
            $table->integer('ticket_status')->comment('1 = available, 2 = not available');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_tickets');
    }
};
