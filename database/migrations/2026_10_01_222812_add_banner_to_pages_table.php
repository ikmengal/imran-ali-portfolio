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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('banner_image')->nullable()->after('slug');
            $table->string('banner_alt')->nullable()->after('banner_image');
            $table->boolean('banner_overlay')->default(false)->after('banner_alt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['banner_image', 'banner_alt', 'banner_overlay']);
        });
    }
};
