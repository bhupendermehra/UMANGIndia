<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'meta_title')) {
                $table->string('meta_title', 70)->nullable()->after('title_hi');
            }
            if (!Schema::hasColumn('articles', 'meta_description')) {
                $table->string('meta_description', 170)->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('articles', 'focus_keyword')) {
                $table->string('focus_keyword', 100)->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('articles', 'featured_image')) {
                $table->string('featured_image', 500)->nullable()->after('content_hi');
            }
            if (!Schema::hasColumn('articles', 'view_count')) {
                $table->unsignedInteger('view_count')->default(0)->after('featured_image');
            }
        });

        Schema::create('seo_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->enum('status', ['pending_review', 'approved', 'rejected', 'imported'])->default('pending_review');
            $table->string('source_url', 500)->nullable();
            $table->string('target_keyword', 100)->nullable();
            $table->string('seo_agent_run_id', 50)->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action', 50);
            $table->string('model_type', 100);
            $table->unsignedBigInteger('model_id')->nullable();
            $table->text('description')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            $table->index(['model_type', 'model_id']);
            $table->index('created_at');
        });

        Schema::create('seo_monitor', function (Blueprint $table) {
            $table->id();
            $table->string('page_url', 500);
            $table->enum('check_type', ['meta_title', 'meta_description', 'h1', 'canonical', 'broken_link', 'alt_text']);
            $table->enum('status', ['pass', 'fail', 'warning']);
            $table->text('issue_detail')->nullable();
            $table->string('suggested_fix', 500)->nullable();
            $table->date('checked_at');
            $table->timestamps();
            $table->index(['page_url', 'check_type']);
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $columns = ['meta_title', 'meta_description', 'focus_keyword', 'featured_image', 'view_count'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('articles', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('seo_drafts');
        Schema::dropIfExists('seo_monitor');
    }
};
