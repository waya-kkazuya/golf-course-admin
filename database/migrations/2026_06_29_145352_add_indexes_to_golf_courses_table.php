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
        Schema::table('golf_courses', function (Blueprint $table) {
            $table->index('locale');
            $table->index('country_code');
            $table->index('state_prefecture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('golf_courses', function (Blueprint $table) {
            $table->dropIndex(['locale']);
            $table->dropIndex(['country_code']);
            $table->dropIndex(['state_prefecture']);
        });
    }
};
