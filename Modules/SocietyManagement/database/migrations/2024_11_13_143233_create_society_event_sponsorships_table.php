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
        Schema::create('society_event_sponsorships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained('society_events')->onDelete('cascade');
            $table->string('sponsor_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->decimal('contribution_amount', 10, 2)->nullable();
            $table->integer('payment_status')->nullable()->comment('1 = pending, 2 = collected');         
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_event_sponsorships');
    }
};
