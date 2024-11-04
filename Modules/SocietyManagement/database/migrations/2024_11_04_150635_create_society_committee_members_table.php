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
        Schema::create('society_committee_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained('society_members')->onDelete('cascade');
            $table->foreignId('committee_id')->nullable()->constrained('society_committees')->onDelete('cascade');
            $table->string('committee_member_designation')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('society_committee_members');
    }
};
