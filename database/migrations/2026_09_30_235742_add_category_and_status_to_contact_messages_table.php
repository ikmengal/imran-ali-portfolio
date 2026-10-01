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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->enum('category', ['general', 'complaint', 'feedback', 'query', 'support'])->default('general')->after('subject');
            $table->enum('status', ['new', 'in_progress', 'resolved', 'closed'])->default('new')->after('category');
            $table->unsignedBigInteger('assigned_to')->nullable()->after('status');
            $table->text('admin_reply')->nullable()->after('message');
            $table->timestamp('replied_at')->nullable()->after('admin_reply');
            $table->unsignedBigInteger('replied_by')->nullable()->after('replied_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['category', 'status', 'assigned_to', 'admin_reply', 'replied_at', 'replied_by']);
        });
    }
};
