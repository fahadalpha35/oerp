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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('profile_pic')->nullable();
            $table->string('full_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('nid_number')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->string('emergency_contact_name_one')->nullable();
            $table->string('emergency_contact_number_one')->nullable();
            $table->string('emergency_contact_relation_one')->nullable();
            $table->string('emergency_contact_name_two')->nullable();
            $table->string('emergency_contact_number_two')->nullable();
            $table->string('emergency_contact_relation_two')->nullable();
            $table->string('emergency_contact_name_three')->nullable();
            $table->string('emergency_contact_number_three')->nullable();
            $table->string('emergency_contact_relation_three')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
