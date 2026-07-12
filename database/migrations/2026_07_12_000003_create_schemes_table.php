<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->string('short_description', 500);
            $table->longText('content');
            $table->text('eligibility')->nullable();
            $table->text('benefits')->nullable();
            $table->text('application_process')->nullable();
            $table->text('required_documents')->nullable();
            $table->string('official_website', 500)->nullable();
            $table->date('application_deadline')->nullable();
            $table->enum('status', ['active', 'closed', 'upcoming'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords', 500)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('is_featured');
            $table->index('published_at');
            $table->index('category_id');
            $table->index('state_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schemes');
    }
};
