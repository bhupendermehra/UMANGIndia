<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            $table->string('title_hi')->nullable()->after('title');
            $table->string('short_description_hi', 500)->nullable()->after('short_description');
            $table->longText('content_hi')->nullable()->after('content');
            $table->text('eligibility_hi')->nullable()->after('eligibility');
            $table->text('benefits_hi')->nullable()->after('benefits');
            $table->text('application_process_hi')->nullable()->after('application_process');
            $table->text('required_documents_hi')->nullable()->after('required_documents');
            $table->string('meta_title_hi')->nullable()->after('meta_title');
            $table->string('meta_description_hi', 500)->nullable()->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            $table->dropColumn([
                'title_hi', 'short_description_hi', 'content_hi',
                'eligibility_hi', 'benefits_hi', 'application_process_hi',
                'required_documents_hi', 'meta_title_hi', 'meta_description_hi',
            ]);
        });
    }
};
