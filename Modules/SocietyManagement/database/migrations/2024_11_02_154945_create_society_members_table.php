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
        Schema::create('society_members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->decimal('membership_fee', 10, 2)->nullable();
            $table->integer('membership_type')->comment('Status of the role: 1 for regular, 2 for premium, 3 for honorary'); // Adding a comment
            $table->integer('active_status')->comment('Status of the role: 1 for active, 2 for inactive'); // Adding a comment
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_members');
    }
};
