<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScanIssues extends Migration
{
    public function up(): void
    {
        Schema::create('scan_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('garment_tracking_id');
            $table->integer('module'); // endline / afterwash

            $table->string('issue_type');
            $table->dateTime('last_reported_at');
            $table->text('missing_fields')->nullable();
            $table->boolean('is_resolved')->default(false);
            $table->integer('repeated_count')->default(1);

            // Timestamp tracking (do not use timestamps() twice)
            $table->timestamp('first_record_at')->nullable();
            $table->timestamp('last_record_at')->nullable();

            // Indexes
            $table->index('garment_tracking_id');
            $table->index('issue_type');
            $table->index('is_resolved');
            $table->index(['garment_tracking_id', 'issue_type', 'is_resolved'], 'idx_item_issues');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scan_issues');
    }
}
