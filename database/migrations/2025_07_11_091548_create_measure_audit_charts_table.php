<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasureAuditChartsTable extends Migration
{
    public function up(): void
    {
        Schema::create('measure_audit_charts', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('chart_id')->comment('link to chart table');
            $table->string('actual');
            $table->decimal('actual_in_decimal');
            $table->float('different');
            $table->boolean('is_positive');
            $table->boolean('is_tally');
            $table->boolean('is_within_tolerance');
            $table->timestamps();

            // Individual indexes
            $table->index('item_id');
            $table->index('is_tally');
            $table->index('is_within_tolerance');
            $table->index('is_positive');
            $table->index('created_at');
            $table->index('updated_at');

            // Composite indexes for common query patterns
            $table->index(['item_id', 'chart_id', 'is_tally'], 'item_tally_index');
            $table->index(['item_id', 'chart_id', 'is_within_tolerance'], 'item_tolerance_index');
            $table->index(['item_id', 'chart_id', 'is_tally', 'is_within_tolerance'], 'item_status_index');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measure_audit_charts');
    }
}
