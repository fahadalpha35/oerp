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
        Schema::create('hr_notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('hr_branches')->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained('hr_departments')->onDelete('cascade');
            $table->string('title'); // Title of the notice
            $table->text('notice_body'); // Full text of the notice
            $table->string('attachment_path')->nullable(); // Optional attachment (PDF, document, etc.)
            $table->date('published_at')->nullable(); // Date the notice was published
            $table->date('valid_until')->nullable(); // Date until the notice is valid
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_notices');
    }
};
