<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStyleIssuesTable extends Migration
{
    public function up(): void
    {
        Schema::create('style_issues', function (Blueprint $table) {
            $table->id();
            $table->string('style_number');
            $table->string('issue_type');
            $table->boolean('is_resolved');
            $table->integer('repeated_count');
            $table->string('from');
            $table->dateTime('last_reported_at');
            $table->dateTime('first_record_at');
            $table->dateTime('last_record_at');
            $table->softDeletes();

            $table->index('style_number');
            $table->index('issue_type');
            $table->index(['style_number', 'issue_type', 'is_resolved'], 'idx_item_issues');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('style_issues');
    }
}
