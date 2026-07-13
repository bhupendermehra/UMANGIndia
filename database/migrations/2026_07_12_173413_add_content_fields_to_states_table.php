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
        Schema::table('states', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('is_central');
            $table->text('short_intro')->nullable()->after('description');
            $table->string('featured_image')->nullable()->after('short_intro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn(['description', 'short_intro', 'featured_image']);
        });
    }
};
