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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');       
            // Adding foreign key constraints
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('active_status')->comment('Status of the role: 1 for active, 2 for inactive'); // Adding a comment
            $table->foreignId('company_business_type')->nullable()->constrained('business_types')->onDelete('cascade');
            $table->date('registration_date')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes(); // Adds deleted_at column for soft deletes
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primary key on email
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Primary key on id
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Foreign key to the users table
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Drop the users table first since it contains foreign key constraints referencing other tables
    Schema::dropIfExists('users');
    
    // // Then drop the other tables
    // Schema::dropIfExists('roles');
    // Schema::dropIfExists('companies');
    // Schema::dropIfExists('business_types');
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('sessions');
    }
};
