<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasureAuditItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('measure_audit_items', function (Blueprint $table) {
            $table->id();
            $table->integer('header_id');
            $table->integer('size_id');
            $table->integer('color_id');
            $table->boolean('is_pass');
            $table->timestamps();

            $table->index('header_id');
            $table->index('size_id');
            $table->index('color_id');
            $table->index(['header_id','is_pass','size_id','color_id'], 'item_result_index');
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('measure_audit_items');
    }
}
